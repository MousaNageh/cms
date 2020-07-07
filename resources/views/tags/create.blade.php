@extends('layouts.app')
@section('content')

    <div class="card card-default">
        @include('partials.errors')
        <div class="card-header">
            {{isset($tag)?"edit tag":"create tag"}}
        </div>
        <div class="card-body">
            @if($errors->any())
            <div class=" alert-danger">
            <ul class="list-group">
            @foreach ($errors->all() as $error)
                <li class="list-group-item alert text-danger">
                {{$error}}
                </li>
            @endforeach
            </ul>
            </div>
            @endif
            <form action="{{isset($tag)?route('tags.update',$tag->id):route('tags.store')}}" method="POST" class="form-horizontal">
            @csrf
            @isset($tag)
                @method("PUT")
            @endisset
            <div class="form-group">
            <label for="name" style="font-weight: bold ">name</label>
            <input type="text" id="name" class="form-control" name="name" placeholder="tag name" value="{{isset($tag)?$tag->name:""}}">
            </div>
            <div class="form-group">
                <input type="submit" value="save" class="btn btn-success btn-lg">
            </div>
            </form>
        </div>
    </div>
@endsection
