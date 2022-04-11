<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function messagesAll(){
        try {

            $messages = Message::all();
            return $messages;

        } catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];
            if($codigoError){
                return "Error $codigoError";
            }

        }
    } 
}
