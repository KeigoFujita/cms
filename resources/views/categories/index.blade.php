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
    <div class="card-header" style="height:50px">Categories
        <a href="{{ route('categories.create') }}" class="btn btn-success btn-sm" style="float:right">Create
            Category</a>
    </div>
    <div class="card-body">


        @if ($categories->count() == 0)
        <div class="d-flex align-content-center flex-wrap" style="height:200px;">
            <div class="text-center" style="width:100%">
                <h1>No categories yet.</h1>
                <a class="text-success" href="{{ route('categories.create') }}">Create a new one.</a>
            </div>
        </div>
        @else

        <table class="table table-bordered table-hover">
            <thead>
                <th>Category</th>
                <th>Posts</th>
                <th width="20%">Actions</th>
            </thead>
            <tbody>

                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name}}</td>
                    <td>{{ $category->posts->count()}}</td>
                    <td>
                        <a role="button" href="{{ route('categories.edit',$category) }}" class="btn btn-sm"
                            style="background-color:#ff971d;color:white;">Edit</a>

                        <form action="{{ route('categories.destroy',$category) }}" method="POST"
                            style="display:inline;">
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
