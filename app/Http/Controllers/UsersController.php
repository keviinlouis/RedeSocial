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

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->validator(['id' => $id], ["id" => "required|numeric|exists:users"]);

        $user = User::where("id", "=", $id)
            ->with('posts')
            ->with('likes')
            ->with('followers')
            ->with('following')
            ->first();

        return response()->json([$user]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function follow($id)
    {
        $this->validator(["id" => $id], ["id" => "required|numeric|exists:users"]);
        if (Auth::user()->id == $id) {
            return response()->json(["message" => ["id" => ["id selecionado é inválido."]]]);
        }
        if (!(new User())->find($id)->followers()->toggle(Auth::user()->id)) {
            return response()->json(['message' => "Error Interno"], 500);
        }
        return response()->json([], 200);
    }

    public function suggested(Request $request)
    {
        $notFollowingUsers = Auth::user()
            ->notFollowing(
                $request->has('actualShowingUsers') ? $request["actualShowingUsers"] : [],
                $request->has('limit') ? $request["limit"] : 5
            );

        return response()->json(['sugestedUsers' => $notFollowingUsers]);
    }


}
