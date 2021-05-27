<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('apikey') !== env('API_KEY')) {
            return response([
                'errors' => [[
                    'message' => 'Unauthorized'
                ]]
            ], 401);
        }
        return $next($request);
    }
}
