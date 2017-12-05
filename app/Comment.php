<?php

namespace App;


class Comment extends Model
{
    //$comment->post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }



    //$comment->user->name
    public function user()
    {
        return $this->belongsTo(Post::class);
    }

    /*Note: given the current comment we have user associate with
    I can simply do that ("$comment->user") and then if I grab the name
     that the user who created
     the comment "$comment->user->name" syntex we use */
}
