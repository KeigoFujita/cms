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
        //gets the poset order by date descending
        $posts = Post::orderBy('created_at', 'desc')->paginate();

        return view('index', [
            'posts' => $posts,
        ]);
    }


    public function filter_by_category(Category $category)
    {

        //gets the poset order by date descending
        $posts = Post::where('category_id', $category->id)->paginate();;

        return view('search.post_search_category', [
            'category' => $category,
            'posts' => $posts,
        ]);
    }


    public function filter_by_tag(Tag $tag)
    {

        //gets posts that has a tag of a given tag
        $posts = Post::whereHas('tags', function ($query) use ($tag) {
            $query->where('tag_id', $tag->id);
        })->paginate(1);

        return view('search.post_search_tag', [
            'tag' => $tag,
            'posts' => $posts,
        ]);
    }

    public function search(Request $request)
    {

        if (empty($request->search)) {
            return redirect(route('home'));
        }

        $posts = Post::where('title', 'LIKE', '%' . $request->search . '%')->orderBy('created_at', 'desc')->paginate();

        return view('search.post_search', [
            'posts' => $posts,
        ]);
    }
}