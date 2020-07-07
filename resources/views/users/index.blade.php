
@extends("layouts.app")
@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3>users</h3>
        </div>
        <div class="card-body text-center">
            <table class="table table-dark">
                <thead>
                    <th>#id</th>
                    <th>name</th>
                    <th>image</th>
                    <th>email</th>
                    <th>auth</th>
                </thead>
                <tbody>
                        @if ($users->count()>0)
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>
                                    <img src="//www.gravatar.com/avatar/md5({{strtolower(trim($user->email))}})" alt="">
                                </td>
                                <td>{{$user->email}}</td>
                                @if ($user->role=="admin")
                                <td>
                                    <form style="display: inline" action="{{route('users.removeadmin',$user->id)}}" method="POST">
                                    @csrf
                                        <button type="submit"  class="btn btn-danger ">make him user</button>
                                    </form>
                                </td>
                                @else
                                <td>
                                    <form style="display: inline" action="{{route('users.makeadmin',$user->id)}}" method="POST">
                                    @csrf
                                        <button type="submit"  class="btn btn-success ">make him admin</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        @else
                        <h3 class="h2"> no users is exists </h3>
                        @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
