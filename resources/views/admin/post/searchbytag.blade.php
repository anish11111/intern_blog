<div id="load" style="position: relative;">
<table class="table table-hover">
                        <thead>
                            <tr>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Tags</th>
                                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
@foreach ($tags as $tag)
  @foreach ($tag->posts as $element)
  <tr>
                  <td><img src="{{ $element->featured }}" alt="" width="50px" height="50px"></td>
                   <td>{{ $element->title }}</td>
                   <td>{{ $element->category->name }}</td>
                   <td><span style="background-color:#0de2a2;color:white;padding: 2px;border-radius: 5px">{{ $tag->tag }}</span></td>
                   <td><a href="{{route('post.edit',['id'=>$element->id])}}" class="btn btn-xs btn-info">Edit</a> &nbsp / &nbsp
                   <a href="{{route('post.delete',['id'=>$element->id])}}" class="btn btn-xs btn-danger">Destroy</a></td>          
                              

  </tr>

     @endforeach

@endforeach
   
 </tbody>
 </table>
 
</div>