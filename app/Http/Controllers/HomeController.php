<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\User;
use App\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
        $this->middleware('auth');
     }
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag_count=Tag::all()->count();
        $post_count=Post::all()->count();
        $trashed_count=Post::onlyTrashed()->count();
        $user_count=User::all()->count();
        $category_count=Category::all()->count();
        return view('admin.dashboard',compact('post_count','trashed_count','user_count','category_count','tag_count'));
    }
}
