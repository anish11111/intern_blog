@extends('layouts.app')
@section('content')
    @include('layouts.error')
    <div class="panel panel-default">

        <div class="panel-heading">
            Edit Tag : {{$tag->tag}}
        </div>
        <div class="panel-body">
            <form method="post" action="{{route('tags.update',['id'=>$tag->id])}}">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="tag">Name</label>
                    <input type=text" name="tag" class="form-control" value="{{$tag->tag}}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Update Tag</button>
                </div>
            </form>
        </div>

    </div>
@endsection