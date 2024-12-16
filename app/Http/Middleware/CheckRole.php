<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    {
        if (!Auth::check()) {
        return response()->json(['message' => 'Unauthorized'], 401);
        }
        $user = Auth::user();
if ($user->role === $role) {
         return $next($request);
        }
            
         return response()->json(['message' => 'Access denied'], 403);
    }
}