
@if (session()->has('needed'))
    <div class="alert alert-danger">
        {{session()->get("needed")}}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="list-group">
            @foreach ($errors->all() as $error)
                <li class="list-group-item">{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->has('depends'))
    <div class="alert alert-danger">
        {{session()->get("depends")}}
    </div>
@endif