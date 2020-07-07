@extends('layouts.app')
@section('content')

    <div class="card card-default">
        @extends('partials.errors') 
        <div class="card-header">
            {{isset($category)?"edit category":"create category"}}
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
            <form action="{{isset($category)?route('category.update',$category->id):route('category.store')}}" method="POST" class="form-horizontal">
            @csrf
            @isset($category)
                @method("PUT")
            @endisset
            <div class="form-group">
            <label for="name" style="font-weight: bold ">name</label>
            <input type="text" id="name" class="form-control" name="name" placeholder="category name" value="{{isset($category)?$category->name:""}}">
            </div>
            <div class="form-group">
                <input type="submit" value="save" class="btn btn-success btn-lg">
            </div>
            </form>
        </div>
    </div>
@endsection
