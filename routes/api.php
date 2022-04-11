<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// users routes

Route::get('/users', [UserController::class, 'show']);
Route::post('/users/register', [UserController::class, 'register']);

//messages routes

Route::get('/messages', [MessageController::class, 'messagesAll']);

//games routes 

Route::get('/games', [GameController::class, 'gamesAll']);

//parties routes 

Route::get('/parties', [PartyController::class, 'All']);


