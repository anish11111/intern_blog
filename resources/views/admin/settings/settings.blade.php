@extends('layouts.app')
@section('content')
    @include('layouts.error')
    <div class="panel panel-default">

        <div class="panel-heading">
            Update Site Settings
        </div>
        <div class="panel-body">
            <form method="post" action="{{route('settings.update')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="sitename">Site Name</label>
                    <input type="text" name="site_name" value="{{$settings->site_name}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name=address value="{{$settings->address}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="number">Contact Number</label>
                    <input type="text" name="contact_number" value="{{$settings->contact_number}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Contact Email</label>
                    <input type="email" name="contact_email" value="{{$settings->contact_email}}" class="form-control">
                </div>



                <div class="form-group">
                    <button type="submit" class="btn btn-success">Update Site Settings</button>
                </div>
            </form>
        </div>

    </div>
@endsection