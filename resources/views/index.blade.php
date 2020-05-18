@extends('layouts.blog')

@section('content')

<!-- Blog Entries Column -->


@if ($posts->count() == 0)

<div class="py-5">
    <p style="font-size:2rem;" class="mb-0">No posts for now</p>
    <p>Check back later</p>
</div>

@else

<h1 class="my-4">Recent Posts</h1>
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

<!-- Pagination -->
<ul class="pagination justify-content-center mb-4">
    <li class="page-item">
        <a class="page-link" href="#">&larr; Older</a>
    </li>
    <li class="page-item disabled">
        <a class="page-link" href="#">Newer &rarr;</a>
    </li>
</ul>
@endif
@endsection
