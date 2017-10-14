<?php

namespace App\Http\Controllers;

use App\Events\NewPost;
use App\Models\Post;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use LRedis;

class PostsController extends Controller
{

    public function index($start){
        $posts = Auth::user()->followingPosts($start);

        return $posts;
    }

    public function storage(Request $request){
        $user_id = Auth::user()->id;

        $request->validate($this->rules());

        $post = Post::create([
            "user_id" => $user_id,
            "text" => $request["text"]
        ]);
       
        //broadcast(new NewPost($post, Auth::user(), $view))->toOthers();
        return response()->json(['post' => $post->where('id', '=', $post->id)->with('user')->first()], 201);
    }

    public function destroy(Request $request){
        if($request->has("id")){
            $post = (new Post())->find($request["id"]);
            if(!is_null($post)){
              $post->delete();
            }else{
               return response()->json(['msg' => "Not Found Post With this id"], 404);
            }
        }else{
            return response()->json(['msg' => "Missing param id"], 400);
        }
    }

    private function rules(){
        $rules = [
            "text" => "string|min:1|max:140|required"
        ];

        return $rules;
    }
}
