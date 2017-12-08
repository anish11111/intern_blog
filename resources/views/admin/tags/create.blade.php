@extends('layouts.app')
@section('content')
    @include('layouts.error')
    <div class="panel panel-default">

        <div class="panel-heading">
            Create A New Tag
        </div>
        <div class="panel-body">
            <form method="post" action="{{route('tags.store')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="tag">Name</label>
                    <input type=text" name="tag" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Store Tag</button>
                </div>
            </form>
        </div>

    </div>
@endsection