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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

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


        if (empty($request->search)) {
            $posts = Post::orderBy('created_at', 'desc')->paginate();
        } else {
            $posts = Post::where('title', 'LIKE', '%' . $request->search . '%')->orderBy('created_at', 'desc')->paginate();
        }

        //gets the poset order by date descending

        return view('index', [
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }


    public function filter_by_category(Request $request, Category $category)
    {

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


        if (empty($request->search)) {
            $posts = $category->posts()->paginate();
        } else {
            $posts = $category->posts()->where('title', 'LIKE', '%' . $request->search . '%')->orderBy('created_at', 'desc')->paginate(1);
        }


        //gets the post order by date descending


        return view('search.post_search_category', [
            'category' => $category,
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }


    public function filter_by_tag(Request $request, Tag $tag)
    {

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

        //gets posts that has a tag of a given tag
        if (empty($request->search)) {
            $posts = $tag->posts()->paginate();
        } else {
            $posts = $tag->posts()->where('title', 'LIKE', '%' . $request->search . '%')->orderBy('created_at', 'desc')->paginate();
        }


        return view('search.post_search_tag', [
            'tag' => $tag,
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }
}