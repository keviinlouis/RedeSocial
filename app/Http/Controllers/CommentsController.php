<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Post;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['user', 'post'])->get();
        return response()->json($comments);
    }

    public function show($id)
    {
        $this->validateRequest(
            ['id' => $id],
            ["id" => "required||exists:comments"]
        );

        $comment = Comment::with(['user', 'post', 'post.user'])->find($id);

        return response()->json($comment);
    }

    public function storage($id, Request $request)
    {
        $request->merge(["id" => $id]);
        $this->validateRequest(
            $request->toArray(),
                [
                    "text" => "required|min:1|max:140",
                    "id" => "required|numeric|exists:posts"
                ]
        );

        $post = Post::find($id);
        if (!$comment = $post->comments()->create(["text" => $request["text"], "user_id" => Auth::user()->id])) {
            return response()->json(['message' => "Error Interno"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json(Comment::with(['user', 'post', 'post.user'])->find($comment->id), Response::HTTP_CREATED);
    }

    public function update($id, Request $request)
    {
        $request->merge(["id" => $id]);
        $this->validateRequest(
            $request->toArray(),
                [
                    "text" => "required|min:1|max:140",
                    "id" => "required||exists:comments"
                ]
        );

        $comment = Auth::user()->comments()->with(['user', 'post', 'post.user'])->find($id);

        if (is_null($comment)) {
            return response()->json(['message' => ["id" => ["Alteração não autorizada"]]], Response::HTTP_UNAUTHORIZED);
        } else if (!$comment->update($request->all())) {
            return response()->json(['message' => "Error Interno"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json($comment);
    }


    public function destroy($id)
    {
        $this->validateRequest(
            ["id" => $id],
            [
                "id" => "required||exists:comments"
            ]);

        $comment = Auth::user()->comments()->with(['user', 'post', 'post.user'])->find($id);

        if (is_null($comment)) {
            return response()->json(['message' => ["id" => ["Alteração não autorizada"]]], Response::HTTP_UNAUTHORIZED);
        } else if (!$comment->delete()) {
            return response()->json(['message' => "Error Interno"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json($comment);
    }
}
