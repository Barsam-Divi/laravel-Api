<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next ,$permision): Response
    {
        if (!auth()->user()->tokenCan($permision))
        {
            return \response()->json([
                'data' => [
                    'message' => 'this action is unauthorized'
                ]
            ])->setStatusCode(403);
        }

        return $next($request);
    }
}
