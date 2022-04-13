<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PartyController extends Controller
{

    public function partiesAll()
{
    Log::info('partiesAll()');

    try {

        $parties = Party::all();
        Log::info('Tasks done');
        return response()->json($parties, 200);

    } catch (\Exception $e) {
        Log::error($e->getMessage());

        return response()->json(['message' => 'Something went wrong'], 500);
    }
}

//Nueva party
public function newParty(Request $request)
{
    Log::info('newParty()');

    try {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'OwnerID' => 'required|string|max:255',
            'Game_id' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed'], 400);
        }

        $party = Party::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'Game_id' => $request->Game_id,
        ]);

        Log::info('Tasks done');
        return response()->json($party, 200);

    } catch (\Exception $e) {

        Log::error($e->getMessage());
        return response()->json(['message' => 'Something went wrong'], 500);
    }
}


//traer party por id
public function partyBygame_id($id)
{
    Log::info('getPartyByID()');

    try {

        $party = Party::find($id);
        Log::info('Tasks done');
        return response()->json($party, 200);

    } catch (\Exception $e) {

        Log::error($e->getMessage());
        return response()->json(['message' => 'Something went wrong'], 500);
    }
}

//Actualizar por id
public function updateParty(Request $request, $id)
{
    Log::info('updateParty()');

    try {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'OwnerID' => 'required|string|max:255',
            'Game_id' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed'], 400);
        }

        $party = Party::find($id);
        $party->name = $request->name;
        $party->OwnerID = $request->OwnerID;
        $party->Game_id = $request->Game_id;
        $party->save();

        Log::info('Tasks done');
        return response()->json($party, 200);

    } catch (\Exception $e) {

        Log::error($e->getMessage());
        return response()->json(['message' => 'Something went wrong'], 500);
    }
}

//delete por id
public function deleteParty($id)
{
    Log::info('deleteParty()');

    try {

        $party = Party::find($id);
        $party->delete();
        Log::info('Tasks done');

        return response()->json(['message' => 'Party deleted'], 200);

    } catch (\Exception $e) {

        Log::error($e->getMessage());
        return response()->json(['message' => 'Something went wrong'], 500);
    }
}

//traer party por id de juego
public function partiesBygame_id($id)
{
    Log::info('partiesBygame_id()');

    try {

        $parties = Party::where('Game_id', $id)->get();
        Log::info('Tasks done');
        return response()->json($parties, 200);

    } catch (\Exception $e) {

        Log::error($e->getMessage());
        return response()->json(['message' => 'Something went wrong'], 500);
    }
}
    // public function All(){
    //     try {

    //         $parties = Party::all();
    //         return $parties;

    //     } catch (QueryException $error) {

    //         $codigoError = $error->errorInfo[1];
    //         if($codigoError){
    //             return "Error $codigoError";
    //         }

    //     }
    // }
}
