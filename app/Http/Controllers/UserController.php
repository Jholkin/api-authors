<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return $request->isJson() ? response()->json(User::all(), 200)
                                    : response()->json(['error' => 'Unauthorized'], 401);
    }

    public function create(Request $request)
    {
        if (!$request->isJson()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required',
            'username' => 'required',
            'password' => 'min:4'
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'username' => $request['username'],
            'password' => Hash::make($request['password']),
            'api_token' => Str::random(60),
        ]);

        return response()->json($user, 201);
    }

    public function getToken(Request $request)
    {
        if ($request->isJson()) {
            try {
                $data = $request->json()->all();

                $user = User::where('username', $data['username'])->first();

                if ($user && Hash::check($data['password'], $user->password)) {
                    return response()->json($user, 200);
                }else {
                    return response()->json(['error' => 'No content'], 406);
                }
            } catch (\ModelNotFoundException $e) {
                return response()->json(['error' => 'No content'], 406);
            }
        }else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}