<?php

namespace App\Http\Controllers;

use Validator;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function getUserById(Request $request, $id)
    {
        $user = User::find($id);
        if (!empty($user)) {
            return response()->json($user, 200);
        }
        return response()->json(['error' => 'Not Found'], 400);
    }

    public function createUser(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|string',
            'username' => 'required|unique:users',
            'email'    => 'required|unique:users|email',
            'password' => 'required|regex:/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/',
        ]);

        $data = $request->json()->all();
        $user = User::create([
            "name"     => $data['name'],
            "username" => $data['username'],
            "email"    => $data['email'],
            "password" => Hash::make($data['password']),
        ]);
        return response()->json($user, 201);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        if (empty($user)) {
            return response()->json(['error' => 'Not Found'], 400);
        }

        return response()->json($user, 200);
    }

    public function deleteUser(Request $request)
    {
        return response()->json('Users Works', 200);
    }

}
