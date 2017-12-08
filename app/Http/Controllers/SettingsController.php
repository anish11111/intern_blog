<?php

namespace App\Http\Controllers;
use App\Setting;
use Session;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public  function  __construct(){
        $this->middleware('admin');
    }
    public  function index()
    {
        $settings=Setting::first();
        return view('admin.settings.settings',compact('settings'));
    }
    public  function  update(){
        //Setting::find();
        $this->validate(request(),[
           'site_name'=>'required',
            'contact_number'=>'required',
            'contact_email'=>'required',
            'address'=>'required'
        ]);
        $settings=Setting::first();
        $settings->site_name=request()->site_name;
        $settings->contact_email=request()->contact_email;
        $settings->contact_number=request()->contact_number;
        $settings->address=request()->address;
        $settings->save();

        Session::flash('success','Site Settings Updates Successfully');
        return  redirect()->back();

    }
}
