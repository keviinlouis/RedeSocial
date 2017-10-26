<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $nextPage = $count >= $limit ? route('listApiPosts', ["start" =>  $start + $limit, "limit" => $limit ]) : null;
        $prevPage = $start - $limit >= 0 ? route('listApiPosts', ["start" =>  $start - $limit, "limit" => $limit ]) : null;

        return response()->json(["_meta" => ["_prev" => $prevPage, "_next" => $nextPage, "lenght" => $count], "posts" => $posts]);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $this->validateRequest(['id' => $id], ["id" => "required|numeric|exists:posts"]);

        $post = Post::with(['user', 'comments', 'comments.user', 'likes'])->withCount(['likes', 'comments'])->find($id);

        return response()->json($post);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storage(Request $request)
    {
        $this->validateRequest($request->toArray(), ["text" => "required|min:1|max:140"]);

        $data = [
            "text" => $request["text"]
        ];

        if (!$post = Auth::user()->posts()->create($data)) {
            return response()->json(['messages' => "Error Interno"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        //TODO Events
        //broadcast(new NewPost($post, Auth::user(), $view))->toOthers();

        return response()->json(Post::with(['user'])->find($post->id), Response::HTTP_CREATED);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function update($id, Request $request)
    {
        $this->validateRequest($request->toArray() + ["id" => $id], ["text" => "required|min:1|max:140", "id" => "required|numeric|exists:posts"]);

        $post = Auth::user()->posts()->with(['comments', 'likes', 'user'])->find($id);

        if(is_null($post)){
            return response()->json(['messages' => ["id" => ["Alteração não autorizada"]]], Response::HTTP_UNAUTHORIZED);
        }else if (!$post->update($request->all())) {
            return response()->json(['messages' => "Error Interno"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json($post);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->validateRequest(["id" => $id], ["id" => "required|numeric|exists:posts"]);

        $post = Auth::user()->posts()->with(['comments', 'likes', 'user'])->find($id);

        if(is_null($post)){
            return response()->json(['messages' => ["id" => ["Alteração não autorizada"]]], Response::HTTP_UNAUTHORIZED);
        }else if (!$post->delete()) {
            return response()->json(['messages' => "Error Interno"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json($post);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function like($id)
    {
        $this->validateRequest(["id" => $id], ["id" => "required|numeric|exists:posts"]);
        $post = Post::with('likes')->find($id);

        if (!$action = $post->likes()->toggle(Auth::user()->id)) {
            return response()->json(['messages' => "Error Interno"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        if(count($action["attached"])>0){
            $action = "liked";
        }else{
            $action = "unliked";
        }
        return response()->json(['action' => $action, "post" => $post]);
    }


    public function repost($id)
    {
        $this->validateRequest(["id" => $id], ["id" => "required|numeric|exists:posts"]);
        $post = Post::with(['likes', 'user'])->find($id);

        if (!$action = $post->reposts()->toggle(Auth::user()->id)) {
            return response()->json(['messages' => "Error Interno"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        if(count($action["attached"])>0){
            $action = "reposted";
        }else{
            $action = "unresposted";
        }
        return response()->json(['action' => $action, "post" => $post]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function comments($id){
        $this->validateRequest(['id' => $id], ["id" => "required|numeric|exists:posts"]);

        $post = Post::with('user')->withCount('comments')->find($id);
        $comments = $post->comments()->with(['user'])->get();

        return response()->json(["post" => $post, "comments" => $comments]);
    }
}
