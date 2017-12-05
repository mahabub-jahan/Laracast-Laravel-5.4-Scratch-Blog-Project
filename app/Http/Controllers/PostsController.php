<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Repositories\Posts;


use Carbon\Carbon;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }


    public function index()
    {


        $posts= Post::latest();//we build query one at a time

        if ($month = request('month')){
            $posts->whereMonth('created_at', Carbon::parse($month)->month); //whereMonth helper function that is exists laravel Builder.php class
        }
        /*
         * Note: note that "$posts->whereMonth" helper function not expected month
         * it expected month number. So we need to convert March => 3, May => 6
         * For that we can use php sticktime or use Carbon
         * */
        if ($year = request('year')){
            $posts->whereYear('created_at', $year); //whereYear helper function that is exists laravel Builder.php class
        }

        $posts= $posts->get();

        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(/*Request $request*/)
    {
        $this->validate(request(),[
            'title' => 'required',
            'body' => 'required'
        ]);

        auth()->user()->publish(
            new Post(request(['title','body']))
        );

       /* Post::create([
            'title' => request('title'),
            'body' => request('body'),
            'user_id' => auth()->id()
            /*
             * 'user_id' => auth()->user()->id or
             * 'user_id' => auth()->id() it's a helper function
             *

        ]);*/

       session()->flash(
           'message' , 'Your post has now been published'
       );

        //And then redirect to the home page.
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        return view('posts.show',compact('post','archives'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
