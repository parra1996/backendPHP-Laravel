<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function gamesAll(){
        try {

            $games = Game::all();
            return $games;

        } catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];
            if($codigoError){
                return "Error $codigoError";
            }

        }
    }
}
