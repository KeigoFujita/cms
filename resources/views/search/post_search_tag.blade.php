@extends('layouts.blog')

@section('content')

<!-- Blog Entries Column -->


@if ($posts->count() == 0)
<h1 class="my-4">No posts for {{ $tag->name }}</h1>
@else
<h1 class="my-4">{{ $posts->total() }} posts for {{ $tag->name }}</h1>
@endif
<!-- Blog Post -->

@foreach ($posts as $post)
<div class="card mb-4">
    <img class="card-img-top" src="{{ asset('storage/'.$post->image) }}" alt="Card image cap">
    <div class="card-body">
        <h2 class="card-title">{{ $post->title }}</h2>
        <p class="card-text">{{ $post->description }}</p>
        <a href="{{ route('posts.view',$post->id)}}" class="btn btn-primary">Read More &rarr;</a>
    </div>
    <div class="card-footer text-muted">
        Posted {{ $post->created_at->diffForHumans() }}
    </div>
</div>

@endforeach

{{ $posts->links() }}
@endsection
