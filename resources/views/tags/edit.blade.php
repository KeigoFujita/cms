@extends('layouts.app')
@section('content')
<div class="card card-default">
    <div class="card-header"> Edit Tag</div>
    <div class="card-body">

        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
        @endforeach
        @endif
        <form action="{{ route('tags.update',$tag) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $tag->name }}">
            </div>
            <div class="form-group mt-5">
                <button type="submit" class="btn btn-success">Update Tag</button>
            </div>
        </form>
    </div>
</div>
@endsection
