<?php

namespace App\Http\Controllers;
use Auth;
use Session;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public  function index(){
        $user=Auth::user();
        return view('admin.users.profile',compact('user'));
    }
    public function update(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'youtube'=>'required|url',
            'fb'=>'required|url'
        ]);

        $user=Auth::user();
        if($request->hasFile('avatar')){
            $avatar=$request->avatar;
            $avatar_new_name=time().$avatar->getClientOriginalName();
            $avatar->move('uploads/avatars',$avatar_new_name);
            $user->profile->avatar='uploads/avatars/'.$avatar_new_name;
            $user->profile->save();
        }

        $user->name=$request->name;
        $user->email=$request->email;
        $user->profile->fb=$request->fb;
        $user->profile->youtube=$request->youtube;
        $user->profile->about=$request->about;
        $user->save();
        $user->profile->save();
        if($request->has('password'))
        {
            $user->password=bcrypt($request->password);
            $user->save();
        }
        Session::flash('success','Profile Updated Successfully ');
        return redirect()->back();
    }


}
