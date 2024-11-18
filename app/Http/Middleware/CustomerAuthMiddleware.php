<?php

namespace App\Http\Middleware;

use App\Models\Users;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomerAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        $authenticate = true ;

        if (!$token) {
            return response()->json([
                "errors" => [
                    'message' => 'Authorization token missing'
                ] 
            ], 401); 
        }

        $user = Users::where('token', $token)->where('role', 'customer')->first();
        if (!$user) {
            $authenticate = false ;
        } else {
            Auth::login($user);
        }

        if (!$authenticate) {
            return response()->json([
                "errors" => [
                    'message' => 'Invalid or unauthorized token'
                ] 
            ], 401);
        }

        return $next($request);
    }
}
