@extends('layouts.app')
@section('content')
    @include('layouts.error')
    <div class="panel panel-default">

        <div class="panel-heading">
            Edit Your Profile
        </div>
        <div class="panel-body">
            <form method="post" enctype="multipart/form-data" action="{{route('user.profile.update')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="username">Userame</label>
                    <input type="text" name="name"  value="{{$user->name}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="tag">Email</label>
                    <input type="email" name="email" value="{{$user->email}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="newpswd">New Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="profile">Upload Your Profile</label>
                    <input type="file" name="avatar"  class="form-control">
                </div>
                <div class="form-group">
                    <label for="youtube">Youtube Profile</label>
                    <input type="text" name="youtube" value="{{$user->profile->youtube}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="fb">Facebook Profile</label>
                    <input type="text" name="fb" value="{{$user->profile->fb}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="about">About You</label>
                    <textarea name="about" id="about" cols="6" rows="6" class="form-control">{{$user->profile->about}}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Upadte Profile</button>
                </div>
            </form>
        </div>

    </div>
@endsection
@section('styles')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
@endsection

@section('scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
    <script>
        $(document).ready(function()
        {
            $('#about').summernote();
        });
    </script>
@endsection