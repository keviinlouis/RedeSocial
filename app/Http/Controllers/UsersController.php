<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

        $this->validateRequest(['id' => $id], ["id" => "required|numeric|exists:users"]);

        $user = User::with(['posts', 'likes', 'comments', 'followers', 'following', 'reposts'])
            ->withCount(['posts', 'likes', 'comments', 'followers', 'following', 'reposts'])
            ->find($id);


        return response()->json($user->getAll());
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
        $this->validateRequest(["id" => $id], ["id" => "required|numeric|exists:users"]);
        if (Auth::user()->id == $id) {
            return response()->json(["message" => ["id" => ["id selecionado é inválido."]]], Response::HTTP_BAD_REQUEST);
        }
        if (!$action = Auth::user()->following()->toggle($id)){
            return response()->json(['message' => "Error Interno"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        if(count($action["attached"])>0){
            $action = "followed";
        }else{
            $action = "unfollowed";
        }
        return response()->json(["action" => $action]);
    }

    /**
     * @param int $limit
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function suggested($limit = 5, Request $request)
    {
        $this->validateRequest(["limit" => $limit], ["limit" => "numeric"]);

        $actualShowingUsers = [];
        if($request->has('actualShowingUsers')) {
            if (is_array($request["actualShowingUsers"])){
                foreach ($request["actualShowingUsers"] as $key => $id){
                    $id = intval($id);
                    if($id>0){
                        $actualShowingUsers[] = $id;
                    }else{
                        return response()->json(["message" => ["actualShowingUsers" => ["id {".$request['actualShowingUsers'][$key]."} selecionado é inválido.", $request['actualShowingUsers'][$key]]]], Response::HTTP_BAD_REQUEST);
                    }
                }
                $actualShowingUsers = $request["actualShowingUsers"];
            }else if(intval($request["actualShowingUsers"])>0){
                $actualShowingUsers = [intval($request["actualShowingUsers"])];
            }else{
                return response()->json(["message" => ["actualShowingUsers" => ["id selecionado é inválido."]]], Response::HTTP_BAD_REQUEST);
            }
        }

        $notFollowingUsers = Auth::user()->notFollowing($actualShowingUsers,$limit );

        return response()->json([
            'suggestedUsers' => $notFollowingUsers,
            'length' => count($notFollowingUsers),
            'pastSuggestedUsers' => $request["actualShowingUsers"],
        ]);
    }



}
