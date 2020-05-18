<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Post;
use App\Tag;
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
            ]
        );
    }



    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', [
            'categories' => $categories,
            'tags' => $tags
        ]);
    }


    public function store(PostStoreRequest $request)
    {

        // dd($request->all());

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

        //dd($post->tags());

        if (isset($request->tags)) {
            $post->tags()->attach($request->tags);
        }

        session()->flash('success', 'Post created successfully.');
        return redirect(route('posts.index'));
    }


    public function edit($id)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $post = Post::find($id);
        return view(
            'posts.edit',
            [
                'post' => $post,
                'categories' => $categories,
                'tags' => $tags
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

        //sync the tags of the post
        if (isset($request->tags)) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->detach();
        }


        $post->save();

        session()->flash('success', 'Post updated successfully.');
        return redirect(route('posts.index'));
    }



    public function delete($id)
    {
        $post = Post::find($id);
        $post->tags()->detach();
        $post->delete();

        Storage::disk('public')->delete($post->image);

        session()->flash('success', 'Post deleted successfully.');
        return redirect(route('posts.index'));
    }
}