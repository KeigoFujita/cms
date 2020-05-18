@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header" style="height:50px">Posts
        <a href="#" class="btn btn-success btn-sm" style="float:right">Create Post</a>
    </div>
    <div class="card-body">

        @forelse ($posts as $post)
        <table class="table table-bordered table-hover">
            <thead>
                <th>Title</th>
                <th>Category</th>
                <th>Image</th>
                <th width="20%">Actions</th>
            </thead>
            <tbody>

                @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td><img src="" width="100px" alt=""></td>
                    <td>

                        <a role="button" href="{{route('posts.edit',$post->id)}}" class="btn btn-sm"
                            style="background-color:#ff971d;color:white;">Edit</a>

                        <form action="#" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">
                                Trash
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @empty
        <div class="d-flex align-content-center flex-wrap" style="height:200px;">
            <div class="text-center" style="width:100%">
                <h1>No posts yet.</h1>
                <a class="text-success" href="#">Create a new one.</a>
            </div>
        </div>
        @endforelse

    </div>
</div>
@endsection
