<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        // return response()->json(['message' => 'Hello World!']);7

        return "hello world";
    }
}
