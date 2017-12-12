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



    @foreach($posts as $post)
  <tr>

                                <td><img src="{{$post->featured}}" width="50px" height="50px" alt="{{$post->title}}"></td>
                                <td>{{$post->title}}</td>
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

   
 </tbody>
 </table>
</div>
 {{ $posts->appends(['cat' => $cat,'tag'=>'all'])->links() }}