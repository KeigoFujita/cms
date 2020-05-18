<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    public function index()
    {

        $posts = Post::all();
        return view(
            'posts.index',
            [
                'posts' => $posts,
                'some' => 'SOme data'
            ]
        );
    }



    public function create()
    {
        $categories = Category::all();
        return view('posts.create', [
            'categories' => $categories
        ]);
    }


    public function store(PostStoreRequest $request)
    {

        //saves the image uploaded and get the path
        $image = $request->file('image')->store('images', 'public');


        //crate the post
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'category_id' => $request->category
        ]);



        // if ($request->tags) {
        //     $post->tags()->attach($request->tags);
        // }

        session()->flash('success', 'Post created successfully.');
        return redirect(route('posts.index'));
    }


    public function edit($id)
    {
        $categories = Category::all();
        $post = Post::find($id);
        return view(
            'posts.edit',
            [
                'post' => $post,
                'categories' => $categories
            ]
        );
    }


    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::find($id);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($post->image);
            $new_image = $request->file('image')->store('images', 'public');
            $post->image = $new_image;
        }


        $post->title = $request->title;
        $post->description = $request->description;
        $post->content = $request->content;
        $post->category_id = $request->category;
        $post->save();

        session()->flash('success', 'Post updated successfully.');
        return redirect(route('posts.index'));
    }



    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete();

        Storage::disk('public')->delete($post->image);

        session()->flash('success', 'Post deleted successfully.');
        return redirect(route('posts.index'));
    }
}