@extends('layouts.blog')

@section('content')

<!-- Title -->
<h1 class="mt-4">{{ $post->title }}</h1>

<!-- Author -->
<p class="lead">
    by
    <a href="#">Start Bootstrap</a>
</p>

<hr>

<!-- Date/Time -->

<p><i class="fa fa-clock-o mr-1"></i> Posted on {{ $post->present_created_at()  }}</p>

<hr>

<!-- Preview Image -->
<img class="img-fluid rounded" src="{{ asset('storage/'. $post->image) }}" alt="">

<hr>

<!-- Post Description -->
<p class="lead">{{ $post->description }}</p>

<!-- Post Content -->
{!! $post->content !!}

<hr>

<!-- Comments Form -->
<div class="card my-4">
    <h5 class="card-header">Leave a Comment:</h5>
    <div class="card-body">
        <form>
            <div class="form-group">
                <textarea class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<!-- Single Comment -->
<div class="media mb-4">
    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
    <div class="media-body">
        <h5 class="mt-0">Commenter Name</h5>
        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras
        purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
        vulputate fringilla. Donec lacinia congue felis in faucibus.
    </div>
</div>

<!-- Comment with nested comments -->
<div class="media mb-4">
    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
    <div class="media-body">
        <h5 class="mt-0">Commenter Name</h5>
        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras
        purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
        vulputate fringilla. Donec lacinia congue felis in faucibus.

        <div class="media mt-4">
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body">
                <h5 class="mt-0">Commenter Name</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
                Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc
                ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            </div>
        </div>

        <div class="media mt-4">
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body">
                <h5 class="mt-0">Commenter Name</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
                Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc
                ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            </div>
        </div>

    </div>
</div>

@endsection

@section('custom-css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
