<?php

namespace App\Http\Controllers;

use Validator;
use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function jwt(User $user)
    {
        $payload = [
            'iss' => "lumen-jwt",
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + (60 * 5)
        ];

        return JWT::encode($payload, env('JWT_SECRET'));
    }

    public function authenticate(User $user)
    {
        $this->validate($this->request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $this->request->input('username');
        $password = $this->request->input('password');

        $userData = User::where('username', $username);

        return response()->json($userData);

        if (empty($userData)) {
            return response()->json(['error' => "This Username doesn't exist."], 400);
        }

        if (Hash::check($password, $user->password)) {
            return response()->json(['token' => $this->jwt($user)], 200);
        }

        return response()->json(['error' => "The username or passowrd is wrong"], 400);
    }
}
