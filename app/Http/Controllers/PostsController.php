<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;


class PostsController extends Controller
{

    /**
     * @param int $start
     * @param int $limit
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($start = 0, $limit = 10){
        $this->validator(['start' => $start, 'limit' => $limit], [ "start" => "numeric"]);

        $posts = Auth::user()->followingPosts($start, $limit);

        $count = count($posts);
        $nextPage = route('getApiPosts', ["start" => ($count >= 10 ? $start+10:null)]);
        $prevPage = route('getApiPosts', ["start" => ($start - 10 > 0 ? $start - 10:null)]);

        return response()->json(["_meta" => ["_prev" => $prevPage, "_next" => $nextPage, "lenght" => $count     ], "data" => $posts]);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function view($id){
        $this->validator(['id' => $id], [ "id" => "required|numeric|exists:posts"]);
        $post = Post::where("id", "=", $id)->with('user')->first();

        return response()->json([$post]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storage(Request $request){
        $this->validator($request->toArray(), [ "text" => "required|min:1|max:140"]);

        if(!$post = Post::create([
            "user_id" => Auth::user()->id,
            "text" => $request["text"]
        ])){
            return response()->json(['message' => "Error Interno"], 500);
        }
       
        //broadcast(new NewPost($post, Auth::user(), $view))->toOthers();
        return response()->json([$post], 201);
    }

    public function update($id, Request $request){
        $this->validator($request->toArray() + ["id" => $id], [ "text" => "required|min:1|max:140", "id" => "required|numeric|exists:posts"]);

        $post = Post::where("id", "=", $id)->first();

        if(!$post->update($request->all())){
            return response()->json(['message' => "Error Interno"], 500);
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request){
        $this->validator($request->toArray(), [ "id" => "required|numeric|exists:posts"]);

        $post = (new Post())->find($request["id"]);
        $post->delete();

        return response()->json([$post], 200);
    }

    /**
     * @param array $data
     * @param array $rules
     */
    private function validator(Array $data, Array $rules){
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
           response()->json(["messages" => $validator->messages()->toArray()], 400)->send();
           exit;
        }
    }
}
