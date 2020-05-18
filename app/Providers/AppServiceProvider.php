<?php

namespace App\Providers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.blog', function ($view) {

            //gets all the categories and then sort them by the number of posts related to them
            //gets only the top 10
            $categories = Category::all()->sortByDesc(
                function ($category) {
                    return $category->posts->count();
                }
            )->take(10);


            //gets the tags and then sort them by the number of posts related to them
            //gets only the top 10
            $tags = Tag::all()->sortByDesc(
                function ($tag) {
                    return $tag->posts->count();
                }
            )->take(10);


            $view->with(
                [
                    'categories' => $categories,
                    'tags' => $tags
                ]
            );
        });
    }
}