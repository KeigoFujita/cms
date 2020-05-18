@extends('layouts.home')

@section('content')
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">




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
                    <a href="#" class="btn btn-primary">Read More &rarr;</a>
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

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Search Widget -->
            <div class="card my-4">
                <h5 class="card-header">Search</h5>
                <div class="card-body">
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Categories Widget -->
            <div class="card my-4">
                <h5 class="card-header">Categories</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">


                            <ul class="list-unstyled mb-0">
                                @foreach ($categories as $category)
                                <li>
                                    <a href="#">{{ $category->name }}</a>
                                </li>

                                @if ($loop->index == 4)
                                @break
                                @endif
                                @endforeach
                            </ul>


                        </div>
                        <div class="col-lg-6">

                            <ul class="list-unstyled mb-0">
                                @foreach ($categories as $category)
                                @if ($loop->index > 4)
                                <li>
                                    <a href="#">{{ $category->name }}</a>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tags Widget -->
            <div class="card my-4">
                <h5 class="card-header">Tags</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">


                            <ul class="list-unstyled mb-0">
                                @foreach ($tags as $tag)
                                <li>
                                    <a href="#">{{ $tag->name }}</a>
                                </li>

                                @if ($loop->index == 4)
                                @break
                                @endif
                                @endforeach
                            </ul>


                        </div>
                        <div class="col-lg-6">

                            <ul class="list-unstyled mb-0">
                                @foreach ($tags as $tag)
                                @if ($loop->index > 4)
                                <li>
                                    <a href="#">{{ $tag->name }}</a>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
</footer>

@endsection
