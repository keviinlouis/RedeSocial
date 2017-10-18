<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Models\Post;

class PostsController extends Controller
{

    /**
     * @param int $start
     * @param int $limit
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($start = 0, $limit = 10)
    {
        $this->validateRequest(['start' => $start, 'limit' => $limit], ["start" => "numeric"]);

        $posts = Auth::user()->followingPosts($start, $limit);

        $count = count($posts);
        $nextPage = route('listApiPosts', ["start" => ($count >= 10 ? $start + 10 : null)]);
        $prevPage = route('listApiPosts', ["start" => ($start - 10 > 0 ? $start - 10 : null)]);

        return response()->json(["_meta" => ["_prev" => $prevPage, "_next" => $nextPage, "lenght" => $count], "data" => $posts]);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $this->validateRequest(['id' => $id], ["id" => "required|numeric|exists:posts"]);

        $post = Post::where("id", "=", $id)->with('user')->first();

        return response()->json([$post]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storage(Request $request)
    {
        $this->validateRequest($request->toArray(), ["text" => "required|min:1|max:140"]);
        $data = [
            "user_id" => Auth::user()->id,
            "text" => $request["text"]
        ];
        if (!$post = Post::create($data)) {
            return response()->json(['message' => "Error Interno"], 500);
        }

        //TODO Events
        //broadcast(new NewPost($post, Auth::user(), $view))->toOthers();

        return response()->json([$post], 201);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function update($id, Request $request)
    {
        $this->validateRequest($request->toArray() + ["id" => $id], ["text" => "required|min:1|max:140", "id" => "required|numeric|exists:posts"]);

        $post = Post::where("id", "=", $id)->first();

        if (!$post->update($request->all())) {
            return response()->json(['message' => "Error Interno"], 500);
        }
        return response()->json([$post], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $this->validateRequest($request->toArray(), ["id" => "required|numeric|exists:posts"]);

        $post = (new Post())->find($request["id"]);
        if (!$post->delete()) {
            return response()->json(['message' => "Error Interno"], 500);
        }

        return response()->json([$post], 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function like($id)
    {
        $this->validateRequest(["id" => $id], ["id" => "required|numeric|exists:posts"]);

        $post = (new Post())->find($id);

        if (!$post->likes()->toggle(Auth::user()->id)) {
            return response()->json(['message' => "Error Interno"], 500);
        }
        return response()->json([], 200);
    }

    public function comment($id, Request $request)
    {
        //TODO
    }

    public function repost($id)
    {
        //TODO
    }
}
