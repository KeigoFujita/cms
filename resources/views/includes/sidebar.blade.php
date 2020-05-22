<ul class="list-group">
    <li class="list-group-item">
        <a href="{{ route('posts.index') }}">Posts</a>
    </li>
    <li class="list-group-item">
        <a href="{{ route('categories.index') }}">Categories</a>
    </li>
    <li class="list-group-item">
        <a href="{{ route('tags.index') }}">Tags</a>
    </li>

    @if (Auth::user()->role == 'admin')
    <li class="list-group-item">
        <a href="{{ route('users.index') }}">Users</a>
    </li>
    @else
    <li class="list-group-item">
        <a href="{{ route('users.view',Auth::user()->id) }}">My Account</a>
    </li>
    @endif

</ul>
