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


    public function create(Request $request){
        $user_id = Auth::user()->id;
        $request->validate($this->rules());

        $post = Post::create([
            "user_id" => $user_id,
            "text" => $request["text"]
        ]);
        $posts = [$post];
        $view = view('posts', ["posts" => $posts, "auth_id" => $user_id])->render();

        //broadcast(new NewPost($post, Auth::user(), $view))->toOthers();

        return response()->json(["html" => $view, "count" => count($posts)]);
    }

    public function destroy(Request $request){
        $post = (new Post())->find(base64_decode($request["id"]));
        if(!is_null($post)){
            $post->delete();
        }
    }

    private function rules(){
        $rules = [
            "text" => "string|min:1|max:140|required"
        ];


        return $rules;
    }
}
