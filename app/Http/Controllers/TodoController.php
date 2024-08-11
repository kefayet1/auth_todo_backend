<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    //
    function todoList(Request $request)
    {
        try {
            $user_id = $request->header("id");
            $todos = Todo::where("user_id", $user_id)->get();

            return response()->json([
                "status" => "success",
                "todos" => $todos
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "Your request failed",
            ]);
        }
    }

    function todoCreate(Request $request)
    {
        try {
            $user_id = $request->header("id");
            $title = $request->input("title");
            $todo = Todo::create([
                "user_id" => $user_id,
                "title" => $title,
            ]);

            return response()->json([
                "status" => "success",
                "todos" => $todo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "Your request failed",
                // "error" => $e
            ]);
        }
    }

    function todoTitleUpdate(Request $request)
    {
        try {
            $user_id = $request->header("id");
            $todo_id = $request->input("todo_id");
            $new_title = $request->input("new_title");
            $updated_todo = Todo::where("user_id", $user_id)
                ->where("id", $todo_id)
                ->update(['title' => $new_title]);
            return response()->json([
                "status" => "success",
                "todos" => $updated_todo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "Your request failed",
                // "error" => $e
            ]);
        }
    }

    function todoCompletedUpdate(Request $request)
    {
        try {
            $user_id = $request->header("id");
            $todo_id = $request->input("todo_id");
            $update_completed = $request->input("update_completed");
            $updated_todo = Todo::where("user_id", $user_id)
                ->where("id", $todo_id)
                ->update(['completed' => $update_completed]);
            return response()->json([
                "status" => "success",
                "todos" => $updated_todo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "Your request failed",
                // "error" => $e
            ]);
        }
    }

    function todoColorUpdate(Request $request)
    {
        try {
            $user_id = $request->header("id");
            $todo_id = $request->input("todo_id");
            $update_color = $request->input("color");
            $updated_todo = Todo::where("user_id", $user_id)
                ->where("id", $todo_id)
                ->update(['colors' => $update_color]);
            return response()->json([
                "status" => "success",
                "todos" => $updated_todo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "Your request failed",
                // "error" => $e
            ]);
        }
    }

    function todoDelete(Request $request)
    {
        try {
            $user_id = $request->header("id");
            $todo_id = $request->input("todo_id");
            $updated_todo = Todo::where("user_id", $user_id)
                ->where("id", $todo_id)
                ->delete();
            return response()->json([
                "status" => "success",
                "todos" => $updated_todo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "Your request failed",
                // "error" => $e
            ]);
        }
    }

    function todoClearCompleted(Request $request)
    {
        try {
            $user_id = $request->header("id");
            $clear_completed_todo = Todo::where("user_id", $user_id)
                ->where("completed", "1")
                ->delete();
            return response()->json([
                "status" => "success",
                "message" => "all completed todo has deleted"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "Your request failed",
                // "error" => $e
            ]);
        }
    }

    function todoAllComplete(Request $request)
    {
        try {
            $user_id = $request->header("id");
            $complete_all_todo = Todo::where("user_id", $user_id)
                ->where("completed", "0")
                ->update(["completed" => "1"]);
            return response()->json([
                "status" => "success",
                "message" => "all completed todo has deleted"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "Your request failed",
            ]);
        }
    }
}
