<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiAuthController extends Controller
{

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if ($validate->fails()) {
            return response()->json(['message' => $validate->errors()], 400);
        }
        // check email
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        // check password
        $isValid =  Hash::check($request->password, $user->password);
        if ($isValid) {
            $access_token = Str::random(64);
            $user->update(['access_token' => $access_token]);
            return response()->json(['message' => 'Login successfully', 'access_token' => $access_token], 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function logout(Request $request)
    {
        $access_token = $request->header("access_token");
        if ($access_token != null) {
            $user = User::where('access_token', $access_token)->first();
            if ($user) {
                $user->update(['access_token' => null]);
                return response()->json(['message' => 'Logged out'], 200);
            } else {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
        } else {
            return response()->json(['message' => 'access token not found'], 401);
        }
    }

    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|confirmed',
        ]);
        if ($validate->fails()) {
            return response()->json(['message' => $validate->errors()], 400);
        }
        // password hash
        $password = bcrypt($request->password);
        //access token 
        $access_token = Str::random(64);
        // create user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'access_token' => $access_token
        ]);
        return response()->json(['message' => 'User created successfully', 'access_token' => $access_token], 201);
    }
}
