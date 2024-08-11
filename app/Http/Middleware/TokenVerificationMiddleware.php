<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenVerificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->input('token');
        $result = JWTToken::VerifyToken($token);
        if ($result == "unauthorized") {
            return redirect('/userLogin');
        } else {
            $user = User::where("email", $result->userEmail)->first();
            if ($user) {
                $request->headers->set('email', $result->userEmail);
                $request->headers->set('id', $user->id);
            }
            return $next($request);
        }
    }
}
