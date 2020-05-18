<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $posts = Post::orderBy('created_at', 'desc')->get();

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

        return view('index', [
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }
}