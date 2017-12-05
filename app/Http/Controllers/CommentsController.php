<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;


class CommentsController extends Controller
{
    //This will receive the post
    public function store(Post $post)
    {
        $this->validate(request(),['body' => 'required|min:2']);

        $post->addComment(request('body'));

       /* //Add a comment to a post
        Comment::create([
            'body' =>request('body'),
            'post_id' => $post->id
        ]);*/
        return back();
    }
}
