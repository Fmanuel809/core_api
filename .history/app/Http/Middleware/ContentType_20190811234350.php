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
        if ($request->isJson() or preg_match('/multipart\/form-data/', $request->headers->get('Content-Type'))) {
            return $next($request);
        }
        return response()->json(['error' => 'Unauthorized'], 401, []);
    }
}
