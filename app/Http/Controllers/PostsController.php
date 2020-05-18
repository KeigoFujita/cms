<?php

namespace App\Http\Controllers;

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
        return view('posts.create');
    }


    public function store(PostStoreRequest $request)
    {

        $image = $request->file('image')->store('images', 'public');

        //dd($image);

        // dd($request->all());

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            // 'published_at' => $request->published_at,
            // 'category_id' => $request->category
        ]);

        // if ($request->tags) {
        //     $post->tags()->attach($request->tags);
        // }

        session()->flash('success', 'Post created successfully.');
        return redirect(route('posts.index'));
    }


    public function edit($id)
    {
        $post = Post::find($id);
        return view(
            'posts.edit',
            [
                'post' => $post
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