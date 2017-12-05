<?php

namespace App;
use Carbon\Carbon;

class Post extends Model
{
    //post->comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /*Note: I will grab the user who created the post($post->user)
    or
    $comment->post->user That will gives us user name of the person who create the post and the
    comment associate with
    */




    public function addComment($body)
    {
        /*Comment::create([
            'body' => $body,
            'post_id' => $this->id
        ]);*/
        //Another Way to represent this
        //Becouse of the relationship 'comments' in Eloquent we write
        $this->comments()->create(compact('body')/*or ['body'=>$body]*/);
    }


    public function scopeFilter($query, $filters)
    {


        if ($month = $filters['month']){
            $query->whereMonth('created_at', Carbon::parse($month)->month); //whereMonth helper function that is exists laravel Builder.php class
        }

        if ($year = $filters['year']){
            $query->whereYear('created_at', $year); //whereYear helper function that is exists laravel Builder.php class
        }


    }

    public static function archives()
    {
        return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
            ->groupBy('year' , 'month')
            ->orderByRaw('min(created_at) desc')
            ->get()
            ->toArray();
    }


    public function tags(){
        // Any post may have many tags
        // Any tag may be applied to many posts
        return $this->belongsToMany(Tag::class);
    }




}
