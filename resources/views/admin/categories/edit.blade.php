@extends('layouts.app')
@section('content')
	@include('layouts.error')
	<div class="panel panel-default">

		<div class="panel-heading">
			Update Category : {{$category->name}}
		</div>
		<div class="panel-body">
			<form method="post" action="{{route('category.update',['id'=>$category->id])}}">
				{{csrf_field()}}
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name"  value="{{$category->name}}" class="form-control">
				</div> 
				
				<div class="form-group">
					<button type="submit" class="btn btn-success">Update Category</button>
				</div>
			</form>
		</div>
		
	</div>
@endsection