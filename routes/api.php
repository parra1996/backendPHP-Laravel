<?php

// use App\Http\Controllers\AuthController;

use App\Http\Controllers\AuthController;
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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [AuthController::class, "userRegister"]);
//L0guear usuario
Route::post('/login', [AuthController::class, "login"]);
//Logout
Route::post('/logout', [AuthController::class, "Logout"]);


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


Route::group([
    'middleware' => 'jwt.auth'
], function () {

    //Listar parties
    Route::get('/parties', [PartyController::class, "partiesAll"]);
    //Nueva party
    Route::post('/parties', [PartyController::class, "newParty"]);
    //Party por id de game
    Route::post('/parties/{id}', [PartyController::class, "partyBygame_id"]);
    //Actualizar party por id
    Route::post('/parties/{id}', [PartyController::class, "updateParty"]);
    //Modificar party
    Route::put('/parties/{id}', [PartyController::class, "deleteParty"]);
    //Borrar party
    Route::delete('/parties/game/{id}', [PartyController::class, "partiesBygame_id"]);
});
