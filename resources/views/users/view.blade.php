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

@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-danger">
    {{$error}}
</div>
@endforeach
@endif

<div class="card">
    <div class="card-header" style="height:50px">Manage Account
    </div>
    <div class="card-body">

        <form action="{{ route('users.update',$user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-4">


                    @if (!isset($user->image))

                    <img src="" alt="" class="avatar shadow" style="display: none;" id="img-avatar">
                    <div class="mb-1">
                        <div class="avatar shadow mx-auto" id="overlay-avatar"
                            style="background-color:{{$user->rand_color}}; display:block;">
                            <p class="text-center">
                                {{$user->initial}}
                            </p>
                        </div>
                    </div>
                    @else
                    <div class="mb-1">
                        <img src="{{ asset('storage/'.$user->image) }}" alt="" id="img-avatar" class="avatar shadow">
                    </div>
                    @endif



                    <div class="form-group mt-3">
                        <label for="avatar">Avatar</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="avatar" accept="image/*"
                                    style="cursor:pointer">
                                <label class="custom-file-label" for="avatar"></label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="title">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                    </div>

                    <div class="form-group">
                        <label for="title">Role</label>
                        <select name="role" class="form-control" @if ( Auth::user()->role == 'writer'
                            || $user==Auth::user() )
                            disabled
                            @endif>
                            @foreach ($roles as $role)
                            <option value="{{$role }}" @if ($user->role == $role)
                                selected
                                @endif
                                >{{ ucfirst($role) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Email</label>
                        <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                    </div>
                </div>
            </div>
            <div class="form-group mt-3 float-right">
                <button type="submit" class="btn btn-success">Update Information</button>
            </div>
        </form>


    </div>
</div>
@endsection

@section('custom-css')
<style>
    .avatar {
        display: block;
        width: 150px;
        height: 150px;
        margin: 0 auto;
        border-radius: 50%;
        border: 1px solid black;

    }

</style>
@endsection


@section('custom-scripts')
<script>
    $('input[type="file"]').change(function (e) {
        try {
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
            $('#img-avatar').attr('src', URL.createObjectURL(event.target.files[0]));
            $('#img-avatar').show();
            $('#overlay-avatar').hide();

        } catch (error) {
            console.log(error.message);
        }
    });

</script>
@endsection
