<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class MessagesController extends Controller
{
    public function show($id){
        $this->validateRequest(["id" => $id], ["id" => "required|exists:messages"]);
        $message = Auth::user()->messages()->with(['sender', 'receiver'])->find($id);

        if(is_null($message)){
            return response()->json(['messages' => ['id' => ["messagem invalida"]]], Response::HTTP_UNAUTHORIZED);
        }
        return response()->json($message, Response::HTTP_OK);
    }
    public function storage(Request $request){
        $this->validateRequest($request->toArray(), [
            'receiver_id' =>
                [
                    'required',
                    Rule::exists('users', 'id')->whereNot('id', Auth::id()),
                ],
            'text' => 'required|string'
        ]);
        $data = [
            'receiver_id' => $request["receiver_id"],
            'text' => $request["text"],
            'opened' => 0
        ];

        if(!$message = Auth::user()->messagesSent()->create($data)){
            return response()->json(['messages' => "Error Interno"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json($message, Response::HTTP_CREATED);
    }
    public function destroy($id){
        $this->validateRequest(["id" => $id], ["id" => "required|exists:messages"]);

        $message = Auth::user()->messagesSent()->find($id);

        if(is_null($message)){
            return response()->json(['messages' => ['id' => ["Alteração não autorizada"]]], Response::HTTP_UNAUTHORIZED);
        }else{
            if(!$message->delete()){
                return response()->json(['messages' => "Error Interno"], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
        return response()->json($message, Response::HTTP_OK);
    }
    public function opened($id){
        $this->validateRequest(["id" => $id], ["id" => "required|exists:messages"]);

        $message = Auth::user()->messagesReceived()->find($id);

        if(is_null($message)){
            return response()->json(['messages' => ['id' => ["Alteração não autorizada"]]], Response::HTTP_UNAUTHORIZED);
        }else{
            if(!$message->update(['opened' => 1])){
                return response()->json(['messages' => "Error Interno"], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
        return response()->json($message, Response::HTTP_OK);
    }


}
