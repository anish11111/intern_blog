<?php

namespace App\Http\Controllers;
use Session;
use Auth;
use App\Post;
use App\Tag;
use App\Category;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();
        return view('admin.post.index',compact('posts'));
    }

    public function search_post(Request $request){
        $search_by = $request->search;
        if($search_by == ""|| is_null($search_by)){
            $posts = Post::with('tags')->paginate(4);
            return view('admin.post.tableajax',compact('posts'));
        }else{

            $posts = Post::with('tags')->where('title','like',"%{$search_by}%")->paginate(4);
           
            return view('admin.post.tableajax',compact('posts'));
        }
    }
   public function Search(Request $request)
        { 
            $cat = $request->cat;
            $tag = $request->tag;

            if (is_null($cat)||is_null($tag)) {

              $posts = Post::with('tags')->paginate(4);
              $categories = Category::all();
              $tags = Tag::all();
              // dd($posts);
              //forajax pagiantion
              if ($request->ajax()) {
               return view('admin.post.tableajax',compact('posts','categories','tags'));  
               //return view('admin.post.tableajax',['posts'=> $posts,$categories,$tags]);  
              } else {
                  return view('admin.post.index',compact('posts','categories','tags'));  
              } 
    //for search by all
            }elseif($cat == 'all' && $tag == 'all' ){

               $posts = Post::with('tags')->paginate(4);
               $categories = Category::all();
               $tags = Tag::all();
               return view('admin.post.tableajax',compact('posts','categories','tags')); 
     //for search by tag
            }elseif($cat == 'all' && $tag != 'all' ){
              $tags = Tag::with('posts')->where('tag',$tag)->get();
               // $tags = Tag::where('tag',$tag)->posts()->get();
              
               // dd($tags);
                return view('admin.post.searchbytag',compact('tags'));
    //for search by category
            }elseif ($cat != 'all' && $tag == 'all') {
                $posts = Post::with('tags')->where('category_id',$cat)->paginate(4);
                //dd($posts);
                return view('admin.post.searchbycat',compact('posts')); 
    //for search by category and tag
            }elseif ($cat != 'all' && $tag != 'all') {
                 $tags = Tag::with('posts')->where('tag',$tag)->get();
                 $posts = array();
                 foreach ($tags as $tag) {
                     foreach($tag->posts as $element){
                        $posts[] = $element->id;
                     }
                 }
                 foreach ($posts as $id) {
                    $ps[] = Post::with('tags')->where([
                        ['id',$id],
                        ['category_id',$cat],
                    ])->get();
                 }
                 
                return view('admin.post.searchbyval',compact('ps'));

            }

            /*if (is_null($search_by)||is_null($input))
            {
		
               // $posts = Post::with(['tags','category'])->get();
              //$posts = Post::with('tags')->get();
               $posts = Post::paginate(4);
               $categories = Category::all();
               $tags = Tag::all();
               // dd($posts);
               return view('admin.post.index',compact('posts','categories','tags'));        
            }
            else
            {
                if ($search_by == 'title') {
                  
               $posts = Post::where($search_by,'like','%'.$input.'%')->paginate(4);
            
               return view('admin.post.tableajax',compact('posts'));
                }elseif($search_by == 'category'){
                    $categories = Category::where('name','like',$input.'%')->first();
                    $cid = $categories->id;
                    $posts = Post::where('category_id','=',$cid)->get();
                    dd($posts);
                    return view('admin.post.tableajax',compact('posts'));
                }elseif ($search_by == 'tag') {
                    $tags = Tag::with('posts')->where('tag','like','%'.$input.'%')->get();
                   // dd($tags);
                    return view('admin.post.searchbytag',compact('tags'));
                }
            }*/
        }
        // public function all(){
        //     $posts = Post::with('tags')->paginate(4);
        //     $categories = Category::all();
        //     $tags = Tag::all();
        //     // dd($posts);
        //     if (request()->ajax()) {
        //      return view('admin.post.tableajax',compact('posts','categories','tags'));  
        //      return view('admin.post.tableajax',['posts'=> $posts,$categories,$tags])->render();  
        //     } else {
        //         return view('admin.post.index',compact('posts','categories','tags'));  
        //     }
            

        // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories=Category::all();
        $tags=Tag::all();
        if($categories->count()==0){
             Session::flash('info','You must have some categories before attemption to Post');
             return redirect()->back();
        }
        if($tags->count()==0){
             Session::flash('info','You must have some tags before attemption to Post');
             return redirect()->back();
        }
        return view('admin/post/create')->with('categories',$categories)
                                        ->with('tags',$tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[
            'title'=>'required',
            'featured'=>'required|image',
            'category_id'=>'required',
            'contents'=>'required',
            'tags'=>'required',
            'status'=>'required',
        ]);

        $featured=$request->featured;
        $featured_new_name=time().$featured->getClientOriginalName();
        $featured->move('uploads/posts',$featured_new_name);
        

        $post=Post::create(
            [
                'title'=>$request->title,
                'contents'=>$request->contents,
                'status'=>$request->status,
                'featured'=>'/uploads/posts/'.$featured_new_name,
                'category_id'=>$request->category_id,
                'slug'=>str_slug($request->title),
                'user_id'=>Auth::id()
            ]
        );
        $post->tags()->attach($request->tags);

        Session::flash('success','Successfully Posted');
        return redirect()->back();

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post=Post::find($id);
        $tags=Tag::all();
        $categories=Category::all();
        return view('admin.post.edit',compact('post','categories','tags'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'title'=>'required',
            'contents'=>'required',
            'category_id'=>'required'
        ]);
        $post=Post::find($id);
        if($request->hasFile('featured'))
        {
            $featured=$request->featured;
            $featured_new_name=time().$featured->getClientOriginalName();
            $featured->move('uploads/posts',$featured_new_name);
            $post->featured='uploads/posts/'.$featured_new_name;
        }
        $post->title=$request->title;
        $post->contents=$request->contents;
        $post->category_id=$request->category_id;
        $post->status = $request->stauts;

        $post->save();
        //post_tag
         $post->tags()->sync($request->tags);

        Session::flash('success','Post Successfully Updated');
        return redirect()->route('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */  
    public function trashed()
    {
        $posts=Post::onlyTrashed()->get();
//        dd($posts);
        return view('admin.post.trash')->with('posts',$posts);
    }
    public function restore()
    {
        $post=Post::onlyTrashed()->first();
        $post->restore();
        Session::flash('success','Post Successfully Restored');
        return redirect()->route('posts');
    }

    public  function  kill($id){
        $post=Post::withTrashed()->where('id',$id)->get();//Collection or array
        $post=Post::withTrashed()->where('id',$id)->first();//Instance of post class
        $post->forceDelete();
        Session::flash('success','Post deleted permanently');
        return redirect()->back();

    }
    public function destroy($id)
    {

        $post=Post::find($id);
        $post->delete();
        Session::flash('success','Your Post was Successfully trashes');
        return redirect()->back();
    }

}
