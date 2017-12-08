<?php

namespace App\Http\Controllers;
use App\Setting;
use App\Post;
use App\User;
use App\Tag;
use Carbon;
use App\Category;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index(){
        return view('index')
            ->with('title',Setting::first()->site_name)
            ->with('categories',Category::take(4)->get())
            ->with('first_post',Post::orderBy('created_at','desc')->first())
            ->with('second_post',Post::orderBy('created_at','desc')->skip(1)->take(1)->get()->first())
            ->with('third_post',Post::orderBy('created_at','desc')->skip(2)->take(1)->get()->first())
            ->with('sports',Category::find(1))
            ->with('education',Category::find(2))
            ->with('settings',Setting::first());

    }


    public  function  singlePost($slug)
    {

        $post=Post::where('slug',$slug)->first();
        $next_id=Post::where('id','>',$post->id)->min('id');
        $prev_id=Post::where('id','<',$post->id)->max('id');
        return view('single')
                ->with('post',$post)
                ->with('title',$post->title)
                ->with('categories',Category::take(4)->get())
                ->with('settings',Setting::first())
                ->with('users',User::first())
                ->with('tags',Tag::all())
                ->with('next',Post::find($next_id))
                ->with('prev',Post::find($prev_id));
    }
    public  function category($id)
    {
        $category=Category::find($id);
        $posts = Post::where('category_id',$id)->get();
        return view('category')->with('category',$category)
                                ->with('posts',$posts)
                                ->with('title',$category->name)
                                ->with('settings',Setting::first())
                                ->with('categories',Category::take(4)->get())
                                ->with('tags',Tag::all());
    }

    public function tag($id)
    {
        $tag=Tag::find($id);
        $tags=Tag::all();
        $title=$tag->tag;
        $settings=Setting::first();
        $categories=Category::take(4)->get();
        return view('tag',compact('tag','tags','title','settings','categories'));
    }
}
