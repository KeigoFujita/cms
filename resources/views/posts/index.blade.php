@extends('layouts.app')

@section('content')


@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session()-> get('success')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="card">
    <div class="card-header" style="height:50px">Posts
        <a href="{{ route('posts.create') }}" class="btn btn-success btn-sm" style="float:right">Create Post</a>
    </div>
    <div class="card-body">


        @if ($posts->count() == 0)
        <div class="d-flex align-content-center flex-wrap" style="height:200px;">
            <div class="text-center" style="width:100%">
                <h1>No posts yet.</h1>
                <a class="text-success" href="{{ route('posts.create') }}">Create a new one.</a>
            </div>
        </div>
        @else

        <table class="table table-bordered table-hover">
            <thead>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
                <th width="20%">Actions</th>
            </thead>
            <tbody>

                @foreach ($posts as $post)
                <tr>
                    <td><img src="{{ asset('storage/'.$post->image) }}" width="100px" alt=""></td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->description}}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>
                        <a role="button" href="{{ route('posts.edit',$post->id) }}" class="btn btn-sm"
                            style="background-color:#ff971d;color:white;">Edit</a>

                        <form action="{{ route('posts.delete',$post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>

        </table>
        @endif

    </div>
</div>
@endsection
