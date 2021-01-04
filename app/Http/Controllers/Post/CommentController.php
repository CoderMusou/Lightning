<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Post $post)
    {
        $comment = Comment::make($request->validated());
        $comment->post()->associate($post);
        $comment->commenter()->associate($this->user());
        $comment->save();

        return back();
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back();
    }
}
