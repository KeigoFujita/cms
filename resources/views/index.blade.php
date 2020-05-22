@extends('layouts.blog')

@section('search-route')
{{ route('home') }}
@endsection
@section('content')

<!-- Blog Entries Column -->


@if ($posts->count() == 0)

@if (request()->has('search'))
<div class="py-5">
    <p style="font-size:2rem;" class="mb-0">No posts for query <strong>'{{ request()->query('search') }}'</strong></p>
    <p>Try other keyword</p>
</div>
@else
<div class="py-5">
    <p style="font-size:2rem;" class="mb-0">No posts for now</p>
    <p>Check back later</p>
</div>
@endif

@else


@if (request()->has('search') && !empty(request()->query('search')))
<h1 class="my-4">Posts with <strong>'{{ request()->query('search') }}'</strong> keyword</h1>
@else
<h1 class="my-4">Recent Posts</h1>
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

{{ $posts->appends(['search'=>request()->query('search')])->links() }}
@endif
@endsection
