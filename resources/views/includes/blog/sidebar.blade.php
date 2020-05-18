<!-- Search Widget -->
<div class="card my-4">
    <h5 class="card-header">Search</h5>
    <div class="card-body">
        <div class="input-group">
            <input type="text" class="form-control">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </div>
</div>

<!-- Categories Widget -->
<div class="card my-4">
    <h5 class="card-header">Categories</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">


                <ul class="list-unstyled mb-0">
                    @foreach ($categories as $category)
                    <li>
                        <a href="#">{{ $category->name }}</a>
                    </li>

                    @if ($loop->index == 4)
                    @break
                    @endif
                    @endforeach
                </ul>


            </div>
            <div class="col-lg-6">

                <ul class="list-unstyled mb-0">
                    @foreach ($categories as $category)
                    @if ($loop->index > 4)
                    <li>
                        <a href="#">{{ $category->name }}</a>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Tags Widget -->
<div class="card my-4">
    <h5 class="card-header">Tags</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">


                <ul class="list-unstyled mb-0">
                    @foreach ($tags as $tag)
                    <li>
                        <a href="#">{{ $tag->name }}</a>
                    </li>

                    @if ($loop->index == 4)
                    @break
                    @endif
                    @endforeach
                </ul>


            </div>
            <div class="col-lg-6">

                <ul class="list-unstyled mb-0">
                    @foreach ($tags as $tag)
                    @if ($loop->index > 4)
                    <li>
                        <a href="#">{{ $tag->name }}</a>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
