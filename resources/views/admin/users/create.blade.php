@extends('layouts.app')
@section('content')
    @include('layouts.error')
    <div class="panel panel-default">

        <div class="panel-heading">
            Create A New User
        </div>
        <div class="panel-body">
            <form method="post" action="{{route('users.store')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Save User</button>
                </div>
            </form>
        </div>

    </div>
@endsection