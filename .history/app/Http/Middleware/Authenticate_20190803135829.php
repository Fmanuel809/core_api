<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use app\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class Authenticate
{
    public function handle($request, Closure $next, $guard = null)
    {
        $jwToken = $request->get('token');
        if (!$jwToken) {
            return response(['error' => "Token not provided."], 401);
        }

        try {

            $credentials = JWT::decode($jwToken, env('JWT_SECRET'), ['HS256']);

        } catch (ExpiredException $e) {
            return response()->json(['error' => "Provided token is expired."], 400);
        } catch (Exception $e) {
            return response()->json(['error' => "An error while decoding token."], 400);
        }

        $user = User::find($credentials->sub);
        $request->auth = $user;

        return $next($request);
    }
}
