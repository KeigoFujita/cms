@extends('layouts.app')
@section('content')
<div class="card card-default">
    <div class="card-header"> Create Category</div>
    <div class="card-body">

        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
        @endforeach
        @endif
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group mt-5">
                <button type="submit" class="btn btn-success">Add Category</button>
            </div>
        </form>
    </div>
</div>
@endsection
