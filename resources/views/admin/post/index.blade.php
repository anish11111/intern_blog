@extends('layouts.app')
@section('styles')
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
@endsection
@section('content')
	
	<div class="panel panel-default">

		<div class="panel-heading">
			All Posts
			<span class="pull-right">
				{{-- <input class="" type="text" id="input_search" placeholder="search content here..."> --}}
				{{-- <select name="" id="select_search">
					<option value="title">By Title</option>
					<option value="category">By Category</option>
					<option value="tag">By Tags</option>
				</select> --}}
				{{-- for live search using title only --}}
				<input class="" type="text" id="search" placeholder="Search by title">
				<label for="select_search_cat">Category: </label>
				<select name="" id="select_search_cat">
					<option value="all">All</option>
					@foreach ($categories as $category)
						<option value="{{ $category->id }}">{{ $category->name }}</option>
					@endforeach
				</select>
				<label for="select_search_tag">Tag: </label>
				<select name="" id="select_search_tag">
					<option value="all">All</option>
					@foreach ($tags as $tag)
						<option value="{{ $tag->tag }}">{{ $tag->tag }}</option>
					@endforeach
				</select>
				<button type="button" class="btn btn-info btn-sm" id="searchButton">Search
				          <span class="glyphicon glyphicon-search"></span>
				</button>
				
			</span>
		</div>
		<div class="panel-body" id="itemsToShow">
			@if(count($posts)>0)
				<div class="posts_table">
					@include('admin.post.tableajax')
					
				</div>
			@endif
		</div>
		
	</div>
@endsection
@section('scripts')
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous">
 </script>
 {{-- for live search for title only --}}
 <script type="text/javascript">
 	$(document).ready(function (){
 		 $("#search").keyup(function(){
           var str=  $("#search").val();
           if(str == "") {
               $.post('{{ url('admin/posts' )}}',
               	{
               	    'search': str,
					'_token': $('input[name=_token]').val()	
               	},
                function( data ) {
                   $("#itemsToShow").html(data);  
            }); 
             }else {
               $.post('{{ url('admin/posts' )}}',
               	{
               	    'search': str,
					'_token': $('input[name=_token]').val()	
               	},
                function( data ) {
                   $("#itemsToShow").html(data);  
            });
       }
   }); 
 	});
 </script>	
 <script type="text/javascript">
 	$(document).ready(function(){
 		$('#searchButton').click(function(){
 			var cat = $("#select_search_cat").val();
 			var tag = $("#select_search_tag").val();
 			console.log(cat);
 			console.log(tag);
 			if(cat && tag){
 				//$("#itemsToShow").html("<b>Tables Info For Search will be Listed here.");
 /*				event.preventDefault();
 			}else{*/
 				$.get("{{ url('admin/posts?cat=') }}"+cat+"&tag="+tag,function(data){
 					$("#itemsToShow").html(data);
 				});
 			}
 		});
 	});
 </script>
 {{-- <script type="text/javascript">
 	// $(document).ready(function(){
 		$(document).on('click','.pagination a', function(event){
 			event.preventDefault();
			 $('#load').append('<img style="position: absolute; left: 150px; top: 0; z-index: 100000;" src="{{asset('uploads/loading2.gif')}}" />');

 			var url = $(this).attr("href");
 			
 			//console.log(page);
 			getPosts(url);

 		});
 		function getPosts(url) {
                $.ajax({
                    url: url,
                }).done(function (data) {
                    $('#itemsToShow').html(data);
                }).fail(function () {
                    alert('Posts could not be loaded.');
                });
            }
 	// });

 </script> --}}
@endsection
