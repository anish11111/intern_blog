@extends('layouts.app')
@section('content')
	@include('layouts.error')
	<div class="panel panel-default">

		<div class="panel-heading">
			Update:{{$post->title}}
		</div>
		<div class="panel-body">
			<form method="post" action="{{route('post.update',['id'=>$post->id])}}" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="form-group">
					<label for="title">Title</label>
					<input type=text" name="title" value="{{$post->title}}" class="form-control">
				</div>
				<div class="form-group">
					<label for="featured">Featured Image</label>
					<input type="file" name="featured"  class="form-control">
				</div>
				<div class="form-group">
					<label for="category">Choose a Category</label>
					<select name="category_id" id="category"  class="form-control">
						@foreach($categories as $category)
							<option value="{{$category->id}}"
									@if($post->category->id==$category->id) selected
									@endif
							>{{$category->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="tags">Choose Tags</label>
					<div class="checkbox">
						@foreach($tags as $tag)
							<label>
								<input type="checkbox" name="tags[]" value="{{$tag->id}}"
									   @foreach($post->tags as $t)
											@if($tag->id==$t->id)
												checked
											@endif
									   @endforeach
								>{{ $tag->tag}}
							</label>
						@endforeach
					</div>

				</div>
				<div class="form-group">
					<label for="content">Content</label>
					<textarea name="contents" id="contents" class="form-control" rows="5" cols="5">{{$post->contents}}</textarea>
				</div>
				<div class="form-group">
					<label for="tags">Check To Publish</label>
					<div class="checkbox">
						
							<label>
							 <input type="checkbox" name="status" value="1">
							</label>
					
					</div>

				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success">Update Post</button>
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
			$('#contents').summernote();
		});
	</script>
@endsection