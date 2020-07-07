@extends('layouts.app')
@section('content')
    <div class="justify-content-end mb-2">
        <a href="{{route('category.create')}}" class="btn btn-success">create category </a>
    </div>
    <div class="card card-default text-center">
        @include('partials.errors') 
        <div class="card-header">
            categories
        </div>
        <div class="card-body">
        @if ($categories->count()>0)
        <table class="table table-dark text-center">
            <thead>
                <th>#id</th>
                <th>name</th>
                <th>created at</th>
                <th>updated at</th>
                <th>posts</th>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->created_at}}</td>
                    <td>{{$category->updated_at}}</td>
                    <td>{{$category->posts->count()}}</td>
                    <td>
                    <a href="{{route('category.edit',$category->id)}}" class="btn btn-success btn-sm mb-2  mb-xl-0">edit</a>
                    </td>
                    <td>
                    <a onclick="comfiming({{$category->id}})" class="btn btn-danger btn-sm mb-2   mb-xl-0" data-toggle="modal" data-target="#deletecategorymodal">delete</a>
                    </td>
                    <td>
                    <form style="display: inline" action="{{route('posts.category-posts',$category->id)}}" method="POST">
                        @csrf
                        @method("PUT")
                        <input type="submit" value="posts" class="btn btn-info btn-sm " >
                    </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @else
            <h3 class="text-center">not categories is exists </h3>
        @endif
            <div class="modal fade" id="deletecategorymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">delete category </h5>
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
    deleteForm.action="/category/"+id ;

}


</script>
