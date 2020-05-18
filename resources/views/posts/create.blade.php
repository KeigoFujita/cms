@extends('layouts.app')
@section('content')

@if (session()->has('success'))

<div class="alert alert-success alert-dismissible fade show">
    {{ session()-> get('success')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@elseif(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show">
    {{ session()-> get('error')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="card card-default">
    <div class="card-header"> Create Post</div>
    <div class="card-body">

        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
        @endforeach

        @endif
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" cols="5" rows="5" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <input id="content_id" type="hidden" name="content">
                <trix-editor input="content_id" style="height:300px" placeholder="Type something amazing...">
                </trix-editor>
            </div>

            <div class="form-group">
                <img src="" alt="" class="img-fluid">
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" accept="image/*"
                            style="cursor:pointer">
                        <label class="custom-file-label" for="image">Choose your image</label>
                    </div>
                </div>

            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <div>
                    <select name="category" class=" form-control">
                        @foreach ($categories as $category )
                        <option value="{{ $category->id}}">{{ $category->name}}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            @if ($tags->count()>0)
            <div class="form-group">
                <label for="tags">Tags</label>
                <select name="tags[]" id="tags" class="form-control tag-selector" multiple>

                    @foreach ($tags as $tag)
                    <option value="{{ $tag->id}}">{{$tag->name}}</option>
                    @endforeach

                </select>
            </div>
            @endif

            <div class="form-group mt-5">
                <button type="submit" class="btn btn-success">Create Post</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('custom-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.3/flatpickr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $('input[type="file"]').change(function (e) {
        try {
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
            $('img').attr('src', URL.createObjectURL(event.target.files[0]));

        } catch (error) {
            console.log(error.message);
        }
    });

    $(document).ready(function () {
        $('.tag-selector').select2();
    });

</script>
@endsection

@section('custom-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endsection
