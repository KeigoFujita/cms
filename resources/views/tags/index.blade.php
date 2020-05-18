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
    <div class="card-header" style="height:50px">Tags
        <a href="{{ route('tags.create') }}" class="btn btn-success btn-sm" style="float:right">Create
            Tag</a>
    </div>
    <div class="card-body">


        @if ($tags->count() == 0)
        <div class="d-flex align-content-center flex-wrap" style="height:200px;">
            <div class="text-center" style="width:100%">
                <h1>No tags yet.</h1>
                <a class="text-success" href="{{ route('tags.create') }}">Create a new one.</a>
            </div>
        </div>
        @else

        <table class="table table-bordered table-hover">
            <thead>
                <th>Tag</th>
                <th width="20%">Actions</th>
            </thead>
            <tbody>

                @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->name}}</td>
                    <td>
                        <a role="button" href="{{ route('tags.edit',$tag) }}" class="btn btn-sm"
                            style="background-color:#ff971d;color:white;">Edit</a>

                        <form action="{{ route('tags.destroy',$tag) }}" method="POST" style="display:inline;">
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
