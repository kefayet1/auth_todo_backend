<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helper\JWTToken;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function userRegistration(Request $request)
    {
        try {
            $name = $request->input("name");
            $email = $request->input("email");
            $password = $request->input("password");

            // Prepare file name & path
            $img = $request->file("img");

            $time = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$time}-{$file_name}";
            $img_url = "uploads/{$img_name}";

            // Upload File
            $img->move(public_path('uploads'), $img_url);

            User::create([
                "name" => $name,
                "email" => $email,
                "password" => $password,
                "user_img" => $img_name
            ]);

            return response()->json([
                "status" => "success",
                "message" => "registration successful"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "User registration failed"
            ]);
        }

    }

    public function userLogin(Request $request)
    {
        try {
            $email = $request->input("email");
            $password = $request->input("password");

            $user = User::where("email", $email)
                ->where("password", $password)
                ->get();

            $count = $user->count();
            $token = JWTToken::CreateToken($email);
            $cookie = cookie('token', $token, 60);

            if ($count == 1) {
                return response()->json([
                    "status" => "success",
                    "message" => "login successful",
                    "token" => $token,
                    "user" => $user
                ])->cookie($cookie);
            }
        } catch (\Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "failed to login",
                "error" => $e
            ]);
        }
    }
}
