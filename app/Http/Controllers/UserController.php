<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function allUsers()
{
    Log::info('allUsers()');

    try {

        $users = User::all();
        Log::info('Tasks done');
        return response()->json($users, 200);

    } catch (\Exception $e) {

        Log::error($e->getMessage());
        return response()->json(['message' => 'Something went wrong'], 500);
    }
}

//Leer usuario por id
public function userByID($id)
{
    Log::info('userByID()');

    try {

        $user = User::find($id);
        Log::info('Tasks done');
        return response()->json($user, 200);

    } catch (\Exception $e) {

        Log::error($e->getMessage());
        return response()->json(['message' => 'Something went wrong'], 500);
    }
}


//Leer usuario por nombre
public function userByName($name)
{
    Log::info('userByName()');

    try {

        $user = User::find($name);
        Log::info('Tasks done');
        return response()->json($user, 200);

    } catch (\Exception $e) {

        Log::error($e->getMessage());
        return response()->json(['message' => 'Something went wrong'], 500);
    }
}

//Actualizar usuario
public function updateUser(Request $request, $id)
{
    Log::info('updateUser()');

    try {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed'], 400);
        }
 
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        Log::info('Tasks done');
        return response()->json($user, 200);

    } catch (\Exception $e) {

        Log::error($e->getMessage());
        return response()->json(['message' => 'Something went wrong'], 500);
    }
}

//Elimiar usuario
public function deleteUser($id)
{
    Log::info('deleteUser()');

    try {

        $user = User::find($id);
        $user->delete();

        Log::info('Tasks done');
        return response()->json(['message' => 'User deleted'], 200);

    } catch (\Exception $e) {

        Log::error($e->getMessage());
        return response()->json(['message' => 'Something went wrong'], 500);
    }
}
    // $userId = user()->id;


    // public function show()
    // {
    //     // return response()->json(['message' => 'Hello World!']);7

    //     return "hello world";
    // }

    // public function register(Request $request)
    // {
        
    //     try {
    //     {
    //         $validator = Validator::make($request->all(), [
    //             'name' => 'required|string|max:255',
    //             'email' => 'required|string|email|max:255|unique:users',
    //             'password' => 'required|string|min:6',
    //         ]);
    
    //         if($validator->fails()){
    //             return response()->json($validator->errors()->toJson(),400);
    //         }
    
    //         $user = User::create([
    //             'name' => $request->get('name'),
    //             'email' => $request->get('email'),
    //             'password' => bcrypt($request->password)
    //         ]);
    
    //         // $token = JWTAuth::fromUser($user);
    
    //         return response()->json(compact('user'),201);

    //     } } catch (\Exception $e) {

    //         return response()->json(['error' => $e->getMessage()], 400);
    //     }
    // }
}
