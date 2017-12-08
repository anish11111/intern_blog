@extends('layouts.app')

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading">
            Users
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <th>Image</th>
                <th>Name</th>
                <th>Permission</th>
                <th>Delete</th>
                </thead>
                <tbody>
                @if($users->count()>0)
                    @foreach($users as $user)
                        <tr>

                            <td><img src="{{asset($user->profile->avatar)}}" width="50px" height="50px" alt="{{$user->name}}" style="border-radius: 50%"></td>
                            <td>{{$user->name}}</td>

                            <td><a href="" class="btn btn-xs btn-danger">
                                  @if($user->admin)
                                        <a href="{{ route('user.not.admin',['id'=>$user->id]) }}" class="btn btn-xs btn-danger">Remove Permission</a>
                                  @else
                                        <a href="{{ route('user.admin',['id'=>$user->id]) }}" class="btn btn-xs btn-success">Make Admin</a>
                                  @endif
                                </a>
                            </td>
                           @if(Auth::id()!=$user->id)
                                <td>
                                    <a href="{{ route('user.delete',['id'=>$user->id]) }}" class="btn btn-xs btn-danger">Delete</a>

                                </td>
                           @endif
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th colspan="5" class="text-center"> No Users</th>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

    </div>
@endsection