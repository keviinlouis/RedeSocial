<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Auth;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function getPosts(){
        $posts = Auth::user()->followingPosts();
        return view('posts', get_defined_vars());
    }

    public function create(Request $request){

        $this->validator($request);

        $post = Post::create([
            "user_id" => Auth::user()->id,
            "text" => $request["text"]
        ]);
    }

    private function validator(Request $request){
        $rules = [
            "text" => "string"
        ];

        return $this->validate($request, $rules);
    }
}
