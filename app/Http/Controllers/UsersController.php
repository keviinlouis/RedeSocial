<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function follow(Request $request){
        if($request->has("id")){
            $user = (new User())->find($request["id"]);
            if(!is_null($user)){
                $user->followers()->attach(Auth::user()->id);
            }else{
               return response()->json(['msg' => "Not Found Post With this id"], 404);
            }
        }else{
            return response()->json(['msg' => "Missing param id"], 400);
        }
    }

    public function sugestedUsers(Request $request){
        $notFollowingUsers =  Auth::user()
            ->notFollowing(
                $request->has('actualShowingUsers')?$request["actualShowingUsers"]:[],
                $request->has('limit')?$request["limit"]:5
            );
        
        return response()->json(['sugestedUsers' => $notFollowingUsers]);
    }
}
