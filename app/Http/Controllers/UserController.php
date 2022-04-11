<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function show()
    {
        // return response()->json(['message' => 'Hello World!']);7

        return "hello world";
    }

    public function register(Request $request)
    {
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);
    
            if($validator->fails()){
                return response()->json($validator->errors()->toJson(),400);
            }
    
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->password)
            ]);
    
            // $token = JWTAuth::fromUser($user);
    
            return response()->json(compact('user','token'),201);
        }
    }
}
