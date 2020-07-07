@extends('layouts.app')
@section('content')
    <div class="justify-content-end mb-2">
        <a href="{{route('posts.create')}}" class="btn btn-success">create post </a>
    </div>
    <div class="card card-default table-bordered text-center">
        <div class="card-header text-left">
            <h2> posts </h2>
        </div>
        <div class="card-body">
                    @if ($posts->count()>0)
                    @foreach ($posts as $post)
                            <div class="row mb-5 border-bottom text-left">
                                <div class="col-md-6">
                                    <div class="post mb-2">
                                        <h3>{{$post->title}}</h3>
                                        <h5>{{$post->description}}</h5>
                                        <p>{{$post->content}}</p>
                                        <p>{{$post->published_at}}</p>
                                        @if(!$post->category->id)
                                            <a href="{{route("category.edit",$post->category->id)}}" class="h3 text-info">{{$post->category->name}}</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="post-image mb-2">
                                        <img src="{{asset("storage/".$post->image)}}" alt="notfound" width="100%" >
                                    </div>
                                </div>
                                <div class="justify-content-end mb-4">
                                    @if (!$post->trashed())
                                    <a href="{{route('posts.edit',$post->id)}}" class="btn btn-success">edit</a>
                                    @else
                                    <form style="display: inline-block" action="{{route('posts.restore',$post->id)}}" method="POST">
                                        @csrf
                                        @method("PUT")
                                        <input type="submit" value="restore" class="btn btn-info">
                                    </form>
                                    @endif
                                    <a onclick="comfiming({{$post->id}})" class="btn btn-danger" data-toggle="modal" data-target="#deletepostmodal">
                                    {{ $post->trashed()?"delete":"Trash"}}</a>
                                </div>
                            </div>
                            <div class="modal fade" id="deletepostmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">{{$post->trashed()? "delete": "trash"}} post </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            are you sure you want to {{$post->trashed()? "delete": "trash"}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-info" data-dismiss="modal">don't {{$post->trashed()? "delete": "trash"}}</button>
                                            <form  id="deletingform" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <input type="submit" value="{{$post->trashed()? "delete": "trash"}}" class="btn btn-danger">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                    @else
                    <h3>no posts is exists !!</h3>
                    @endif
        </div>
    </div>
<style>

</style>
@endsection
<script>
function comfiming(id){
    let deleteForm =document.getElementById("deletingform") ;
    deleteForm.action="/posts/"+id ;

}


</script>
