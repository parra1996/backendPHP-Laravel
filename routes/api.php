<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\UserController;
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



//Endpoints de Login
//Registrar usuario
Route::post('/register', [AuthController::class, "userRegister"]);
//L0guear usuario
Route::post('/login', [AuthController::class, "userLogin"]);
//Logout
Route::post('/logout', [AuthController::class, "userLogout"]);

Route::group([
    'middleware' => 'jwt.auth'
], function () {
//Endpoints de usuarios

//Leer perfil //lo meto aqui proque necesita jwt
Route::get('/profile', [AuthController::class, 'profile']);
//Leer todos los usuario
Route::get('/users', [UserController::class, 'allUsers']);
//Leer usuario por id
Route::get('/users/{id}', [UserController::class, 'userByID']);
//Leer usuario por nombre
Route::get('/users/name/{name}', [UserController::class, 'userByName']);
//Actualizar usuario por id
Route::put('/users/{id}', [UserController::class, 'updateUser']);
//Eliminar usuario por id
Route::delete('/users/{id}', [UserController::class, 'deleteUser']);

});

// users routes

// Route::get('/users', [UserController::class, 'show']);
// Route::post('/users/register', [UserController::class, 'register']);

//messages routes

Route::group([
    'middleware' => 'jwt.auth'
], function () {
//Endpoints de mensajes

//leer todos los mensajes
Route::get('/messages', [MessageController::class, 'allMessages']);
//Crear nuevo mensaje
Route::post('/messages', [MessageController::class, 'newMessage']);
//Leer mensaje por id
Route::get('/messages/{id}', [MessageController::class, 'messageByID']);
//Actualizar mensaje por id
Route::put('/messages/{id}', [MessageController::class, 'updateMessage']);
//borrar mensaje
Route::delete('/messages/{id}', [MessageController::class, 'deleteMessage']);
//Leer mensajes por id party
Route::post('/message/party/{id}', [MessageController::class, "messagesByPartyID"]);
});

//games routes 


Route::group([
    'middleware' => 'jwt.auth'
], function () {
//Endpoints de Games

//Listar juegos
Route::get('/games', [GameController::class, "gamesAll"]);
//Juego por id
Route::post('/games', [GameController::class, "gamesAdd"]);
//Nuevo juego
Route::post('/games/{id}', [GameController::class, "gameByID"]);
//Editar juego
Route::put('/games/{id}', [GameController::class, "updateGame"]);
//Borrado de juego
Route::delete('/games/{id}', [GameController::class, "deleteGame"]);
});


//parties routes 

Route::get('/parties', [PartyController::class, 'All']);


