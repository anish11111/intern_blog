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

@foreach($ps as $p)
    @foreach ($p as $element)
            {{-- expr --}}
       <tr>
         <td><img src="{{$element->featured}}" width="50px" height="50px" alt="{{$element->title}}"></td>
        <td>{{$element->title}}</td>
        <td>{{$element->category->name}}</td>

        <td>@foreach ($element->tags as $ele)
            <span style="background-color:#0de2a2;color:white;padding: 2px;border-radius: 5px;">{{ $ele->tag }}</span>
        @endforeach</td>
        <td><a href="{{route('post.edit',['id'=>$element->id])}}" class="btn btn-xs btn-info">Edit</a> &nbsp / &nbsp
        <a href="{{route('post.delete',['id'=>$element->id])}}" class="btn btn-xs btn-danger">Destroy</a></td>
    </tr>
    @endforeach
     
@endforeach

 </tbody>
 </table>
</div>

