@extends('layouts.app')
@section('content')
    <div class="justify-content-end my-2">
        <a href="{{route('tags.create')}}" class="btn btn-success">create tag </a>
    </div>
    <div class="card card-default text-center"> 
        @include('partials.errors') 
        <div class="card-header">
            <h3 class="h2">tags</h3>
        </div>
        <div class="card-body">
        @if ($tags->count()>0)
        <table class="table table-dark text-center">
            <thead>
                <th>#id</th>
                <th>name</th>
                <th>posts</th>
                <th>created at</th>
                <th>updated at</th>

            </thead>
            <tbody>
                @foreach ($tags as $tag)
                <tr>
                    <td>{{$tag->id}}</td>
                    <td>{{$tag->name}}</td>
                    <td>{{$tag->posts->count()}}</td>
                    <td>{{$tag->created_at}}</td>
                    <td>{{$tag->updated_at}}</td>
                    {{-- <td>{{$tag->posts->count()}}</td> --}}
                    <td>
                        <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-success btn-sm mb-2  mb-xl-0">edit</a>
                    </td>
                    <td>
                        <a href="{{route('tags.showposts',$tag->id)}}" class="btn btn-info btn-sm mb-2  mb-xl-0">posts</a>
                    </td>
                    <td>
                        <a onclick="comfiming({{$tag->id}})" class="btn btn-danger btn-sm mb-2   mb-xl-0" data-toggle="modal" data-target="#deletetagmodal">delete</a>
                    </td>
                    {{-- <td>
                    <form style="display: inline" action="{{route('posts.tag-posts',$tag->id)}}" method="POST">
                        @csrf
                        @method("PUT")
                        <input type="submit" value="posts" class="btn btn-info btn-sm " >
                    </form>
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>

        @else
            <h3 class="text-center">not tags is exists </h3>
        @endif
            <div class="modal fade" id="deletetagmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">delete tag </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            are you sure you want to delete
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">don't delete</button>
                            <form action="" id="deletingform" method="POST">
                            @csrf
                            @method("DELETE")
                            <input type="submit" value="delete" class="btn btn-danger">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
function comfiming(id){
    let deleteForm =document.getElementById("deletingform") ;
    deleteForm.action="/tags/"+id ;

}


</script>
