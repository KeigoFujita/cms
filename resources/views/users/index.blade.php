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
    <div class="card-header" style="height:50px">Users</div>
    <div class="card-body">

        <table class="table table-bordered table-hover">
            <thead>
                <th width="10%">Image</th>
                <th>Name</th>
                <th>Role</th>
                <th width="25%">Actions</th>
            </thead>
            <tbody>

                @foreach ($users as $user)
                <tr>
                    <td>

                        @if (!isset($user->image))
                        <div class="avatar-sm shadow mx-auto d-block" style="background-color:{{$user->rand_color}}">
                            <p class="text-center py-" style="font-size: 1.5rem; padding-top:2px; color:white;">
                                {{$user->initial}}
                            </p>
                        </div>
                        @else
                        <img src="{{ asset('storage/'.$user->image) }}" alt="" class="avatar-sm shadow mx-auto d-block">
                        @endif

                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->present_role()}}</td>
                    <td>
                        <a role="button" href="{{ route('users.view',$user) }}" class="btn btn-sm"
                            style="background-color:#ff971d;color:white;">Manage</a>

                        @if ($user->role != 'admin')
                        <a role="button" href="{{ route('users.makeAdmin',$user) }}" class="btn btn-success btn-sm">Make
                            Admin</a>
                        @endif

                    </td>
                </tr>
                @endforeach

            </tbody>

        </table>


    </div>
</div>
@endsection
