@extends('layouts.app')

@section('content')

        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Dashboard</div>--}}

                {{--<div class="panel-body">--}}
                    {{--@if (session('status'))--}}
                        {{--<div class="alert alert-success">--}}
                            {{--{{ session('status') }}--}}
                        {{--</div>--}}
                    {{--@endif--}}

                    {{--You are logged in!--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

    <div class="col-lg-3">
        <div class="panel panel-info">
            <div class="panel-heading text-center">
                PUBLISHED POSTS
            </div>
            <div class="panel-body text-center">
                {{$post_count}}
            </div>

        </div>
    </div>
     <div class="col-lg-3">
            <div class="panel panel-danger">
                <div class="panel-heading text-center">
                    TRASHED POSTS
                </div>
                <div class="panel-body text-center">
                    {{$trashed_count}}
                </div>

            </div>
     </div>
     <div class="col-lg-3">
            <div class="panel panel-info">
                <div class="panel-heading text-center">
                    USERS
                </div>
                <div class="panel-body text-center">
                   {{$user_count}}
                </div>

            </div>
     </div>
     <div class="col-lg-3">
            <div class="panel panel-success">
                <div class="panel-heading text-center">
                    CATEGORIES
                </div>
                <div class="panel-body text-center">
                    {{$category_count}}
                </div>
            </div>
     </div>
 <div class="col-lg-3">
            <div class="panel panel-success">
                <div class="panel-heading text-center">
                    TAGS
                </div>
                <div class="panel-body text-center">
                    {{$tag_count}}
                </div>
            </div>
     </div>

@endsection
