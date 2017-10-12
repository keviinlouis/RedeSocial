<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function getPosts($last = null, $direction = null){
        $first = 0;
        if(!is_null($last)){
            $last = Carbon::createFromFormat("Y-m-d H:i:s", base64_decode($last));
            if($direction === 'first'){
                $between = [$last->toDateTimeString(), Carbon::now()->toDateTimeString()];
            }else{
                $between = [$last->subHour(1)->toDateTimeString(), $last->addHour(1)->toDateTimeString()];

            }
        }else{
            $first = 1;
            $until = Carbon::now()->subHour(3);
            $between = [$until->toDateTimeString(), Carbon::now()->toDateTimeString()];
        }

        $posts = Auth::user()->followingPosts($between, $first);
        $auth_id = Auth::user()->id;
        Carbon::setLocale(config('app.locale'));
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
        $auth_id = Auth::user()->id;
        $view = view('posts', get_defined_vars())->render();

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
