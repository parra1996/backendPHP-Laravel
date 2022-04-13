<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{

    function newMessage(Request $request)
    {
        Log::info('newMessage()');
    
        try {
    
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'content' => 'required|string|max:255',
                'user_id' => 'required|integer',
                'party_id' => 'required|integer',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['message' => 'Validation failed'], 400);
            }
    
            $message = Message::create([
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => $request->user_id,
                'party_id' => $request->party_id,
            ]);
    
            Log::info('Tasks done');
            return response()->json($message, 200);
    
        } catch (\Exception $e) {
    
            Log::error($e->getMessage());
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
    
    
    //Leer mensajes por id
    public function messageByID($id)
    {
        Log::info('messageByID()');
    
        try {
    
            $message = Message::find($id);
            Log::info('Tasks done');
            return response()->json($message, 200);
    
        } catch (\Exception $e) {
    
            Log::error($e->getMessage());
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
    
    
    
    //Modificar mensaje por id
    public function updateMessage(Request $request, $id)
    {
        Log::info('updateMessage()');
        try {
    
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'content' => 'required|string|max:255',
                'user_id' => 'required|integer',
                'party_id' => 'required|integer',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['message' => 'Validation failed'], 400);
            }
    
            $message = Message::find($id);
            $message->title = $request->title;
            $message->content = $request->content;
            $message->user_id = $request->user_id;
            $message->party_id = $request->party_id;
            $message->save();
    
            Log::info('Tasks done');
            return response()->json($message, 200);
    
        } catch (\Exception $e) {
    
            Log::error($e->getMessage());
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
    
    
    
    //eliminar mensaje por id
    public function deleteMessage($id)
    {
        Log::info('deleteMessage()');
    
        try {
    
            $message = Message::find($id);
            $message->delete();
            Log::info('Tasks done');
            return response()->json($message, 200);
    
        } catch (\Exception $e) {
    
            Log::error($e->getMessage());
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
    
    
    
    
    // Leer mensajes por id de party
    public function messagesByPartyID($id)
    {
        Log::info('messagesByPartyID()');
    
        try {
    
            $messages = Message::where('party_id', $id)->get();
            Log::info('Tasks done');
            return response()->json($messages, 200);
    
        } catch (\Exception $e) {
    
            Log::error($e->getMessage());
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }



    // public function messagesAll(){
    //     try {

    //         $messages = Message::all();
    //         return $messages;

    //     } catch (QueryException $error) {

    //         $codigoError = $error->errorInfo[1];
    //         if($codigoError){
    //             return "Error $codigoError";
    //         }

    //     }
    // } 
}
