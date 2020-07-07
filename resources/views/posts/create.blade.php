@extends('layouts.app')
@section('content')

    <div class="card card-default">
        <div class="card-header">
            @include('partials.errors')
            <h3>
                {{isset($post)?"edit post":"create post"}}
            </h3>
        </div>
        <div class="card-body">
            
            <form action="{{isset($post)?route('posts.update',$post->id):route('posts.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @isset($post)
                    @method("PUT")
                @endisset
                <div class="form-group">
                    <label for="title">title </label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="post title" value="{{isset($post)?$post->title:""}}">
                </div>
                <div class="form-group">
                    <label for="description">description</label>
                    <input id="descriptions" type="hidden" name="description" value="{{isset($post)?$post->description:""}}">
                    <trix-editor input="descriptions"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="content">content</label>
                    <input id="contents" type="hidden" name="content" value="{{isset($post)?$post->content:""}}">
                    <trix-editor input="contents"></trix-editor>

                </div>
                @if (!isset($post))
                <div class="form-group">
                    <label for="published_at">published At</label>
                    <input type="datetime-local"  class="form-control" name="published_at" id="published_at" placeholder="published At" value="{{isset($post)?$post->published_at:""}}">
                </div>
                @endif
                @isset($post)
                    <div class="tect-center">
                        <img style="width: 50% ; height: 400px  " src="{{ asset("storage/".$post->image)}}" >
                    </div>
                @endisset

                <div class="form-group">
                    <label for="category">category</label>
                    <select name="category" id="category" class="form-control">
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}"
                        @if(isset($post)&& $category->id==$post->category_id)
                            selected
                        @endif>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                @if (isset($tags)&&$tags->count()>0)
                    <div class="form-group">
                        <label for="tags">tags</label>
                        <select name="tags[]" id="tags" class="form-control select-tags" multiple>
                            @foreach ($tags as $tag)
                            <option value="{{$tag->id}}"
                            @if (isset($post)&&$post->hasTag($tag->id))
                                selected
                            @endif

                            >{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="form-group">
                    <label for="image">post image</label>
                    <input type="file" class="form-control" name="image" id="image" placeholder="image" >
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control btn btn-success col-3" value="save" >
                </div>
            </form>

        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css" >
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" defer></script>
<script>
$(document).ready(function() {
    $('.select-tags').select2();
});
</script>
@endsection
