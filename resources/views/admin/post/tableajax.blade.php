<div id="load" style="position: relative;">
    
<table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Tag</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>


@if ($posts->count()>0)
    @foreach($posts as $post)
  <tr>

                                <td><img src="{{$post->featured}}" width="50px" height="50px" alt="{{$post->title}}"></td>
                                @if(!$search_by)
                                    <td>{{$post->title}}</td>
                                @else
                                    <td>{!!str_ireplace($search_by, $replace_word, $post->title) !!}</td>
                                @endif
                                <td>{{$post->category->name}}</td>
                                 <td>
                                    @foreach ($post->tags as $post_tag)
                                    <span style="background-color:#0de2a2;color:white;padding: 2px;border-radius: 5px">{{$post_tag->tag}}</span>
                                    @endforeach
                                                
                                </td>
                                <td><a href="{{route('post.edit',['id'=>$post->id])}}" class="btn btn-xs btn-info">Edit</a> &nbsp / &nbsp
                                <a href="{{route('post.delete',['id'=>$post->id])}}" class="btn btn-xs btn-danger">Destroy</a></td>

    </tr>
     @endforeach
@else
    <tr><th>No results Found</th></tr>
@endif

   
 </tbody>
 </table>
</div>    


 {{ $posts->links() }}
 