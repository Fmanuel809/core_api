<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
        return response()->json(['error' => 'Not Found'], 404);
    }

    public function createUser(Request $request)
    {
        $data = $request->json()->all();
        return response()->json($data, 200);
    }

    public function updateUser(Request $request)
    {
        return response()->json('Users Works', 200);
    }

    public function deleteUser(Request $request)
    {
        return response()->json('Users Works', 200);
    }

}
