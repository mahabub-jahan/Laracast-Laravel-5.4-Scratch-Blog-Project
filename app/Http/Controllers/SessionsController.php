<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest',['except' => 'destroy']);
    }


    public function create()
    {
        return view('sessions.create');
    }


    public function store()
    {
        // Attempt to authenticate the user.
        if(! auth()->attempt(request(['email', 'password']))) {
           return back()->withErrors([
               'message' => 'Please check your credentials and try again'
           ]);
        }
        /*
         * The attempt method takes care all the logic related
         * to comparing this credentials against what we have store in database,
         * if they match they will automatically sign the user in
         *
         * */

        // Redirect to the home page.
        return redirect()->home();


    }

    public function destroy()
    {
        auth()->logout();

        return redirect()->home();
    }
}
