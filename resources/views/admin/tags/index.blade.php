@extends('layouts.app')
@section('content')

    <div class="panel panel-default">

        <div class="panel-heading">
            Tag list
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <th>Tag Name</th>
                <th>Edit</th>
                <th>Delete</th>
                </thead>
                <tbody>
                @if($tags->count()>0)
                    @foreach($tags as $tag)
                        <tr>
                            <td>{{$tag->tag}}</td>
                            <td><a href="{{route('tags.edit',['id'=>$tag->id])}}" class="btn btn-xs btn-info">Edit</a></td>
                            <td><a href="{{route('tags.delete',['id'=>$tag->id])}}" class="btn btn-xs btn-danger">Delete</a></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th colspan="5" class="text-center"> No Tags Found</th>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

    </div>
@endsection