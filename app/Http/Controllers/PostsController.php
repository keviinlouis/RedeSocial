<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function getPosts($last = null, $direction = null){

        if(!is_null($last)){
            $last = Carbon::createFromFormat("Y-m-d H:i:s", base64_decode($last));
            if($direction === 'first'){
                $until = Carbon::now();
                $between = [$last->toDateTimeString(), $until->toDateTimeString()];
            }else{
                $until = $last->subHour(1);
                $between = [$until->toDateTimeString(), $last->toDateTimeString()];
            }
        }else{
            $until = Carbon::now()->subHour(3);
            $between = [$until->toDateTimeString(), Carbon::now()->toDateTimeString()];
        }

        $posts = Auth::user()->followingPosts($between);

        $view = view('posts', get_defined_vars())->render();

        return response()->json(["html" => $view, "count" => count($posts)]);
    }

    public function create(Request $request){

        $request->validate($this->rules());

        $post = Post::create([
            "user_id" => Auth::user()->id,
            "text" => $request["text"]
        ]);
        $posts = [$post];
        $view = view('posts', get_defined_vars())->render();
        return response()->json(["html" => $view, "count" => count($posts)]);
    }

    private function rules(){
        $rules = [
            "text" => "string|min:1|max:140|required"
        ];


        return $rules;
    }
}
