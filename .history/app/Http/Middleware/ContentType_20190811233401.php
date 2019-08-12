<?php

namespace App\Http\Middleware;

use Closure;

class ContentType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->isJson() or $request->headers->get('Content-Type') != 'multipart/form-data') {
            return response()->json(['error' => 'Unauthorized'], 401, []);
        }
        return $next($request);
    }
}
