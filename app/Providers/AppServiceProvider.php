<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Billing\Stripe;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       view()->composer('layouts.sidebar',function($view){
           $archives = \App\Post::archives();
           $tags = \App\Tag::has('posts')->pluck('name');
           $view->with(compact('archives', 'tags'));
       }); //or ue can use \View::
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
            $this->app->singleton(Stripe::class, function (){
                    return new Stripe(config('services.stripe.secret'));

                /*
                 * or use \App::singleton('App\Billing\Stripe', function (){
                 * return new \App\Billing\Stripe(config('services.stripe.secret'));
                 * });
                 *
                 * or use use \App\Billing\Stripe;
                 *  $this->app->singleton(Stripe::class, function (){
                    return new Stripe(config('services.stripe.secret'));
                 *
                 *
                 * */
        });
    }
}
