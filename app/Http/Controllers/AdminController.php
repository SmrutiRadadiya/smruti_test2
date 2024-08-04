<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Blogs;
use Hash;


class AdminController extends Controller
{
    // register
    public function register (Request $request) {
        return view ('/register');
    }
    public function register_user (Request $request) {
        $rules= array(
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        );

        $error= validator::make($request->all(),$rules);
        if($error->fails())
        {
    	    return response()->json(['errors'=>$error->errors()->all()]);
        }

        $form_data=array(
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password
        );
        User::create($form_data);
        $request->session()->put('email', $request->email);
        return redirect ('/blogs')->with('status',"you have Succesfully register");
    }

    // login logout
    public function login (Request $request) {
        return view ('/login');
    }
    public function login_user (Request $request) {
        $email = $request->get('email');
        $password = $request->get('password');

        $user_email = User::where('email',$email)->where('password',$password)->first();

        if($user_email) {
            $request->session()->put('email',$email);
            $request->session()->put('rightPassword',"right login details");
            return redirect('/blogs');
        } else {
            $request->session()->put('email',"");
            $request->session()->put('wrongPassword',"wrong login details");
            return redirect('/login');
        }
    }
    public function logout (Request $request) {
        Session::forget('email');
        return redirect ('/blogs');
    }

    // Blog CRUD
    public function blogs (Request $request) {
        $blogs = Blogs::get();
        return view ('/blogs',compact('blogs'));
    }
    public function add_blogs (Request $request) {
        $rules= array(
            'title' => 'required',
            'content' => 'required'
        );

        $error= validator::make($request->all(),$rules);
        if($error->fails())
        {
    	    return response()->json(['errors'=>$error->errors()->all()]);
        }

        $form_data=array(
            'title'=>$request->title,
            'content'=>$request->content,
        );
        Blogs::create($form_data);
        return redirect ('/blogs')->with('status',"you have Succesfully add blog");
    }
    public function edit_blogs (Request $request) {
        $rules= array(
            'id' => 'required',
        );

        $error= validator::make($request->all(),$rules);
        if($error->fails())
        {
    	    return response()->json(['errors'=>$error->errors()->all()]);
        }

        Blogs::where('id',$request->id)->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        return redirect ('/blogs')->with('status',"you have Succesfully update blog");
    }
    public function delete_blogs (Request $request) {
        $rules= array(
            'id' => 'required',
        );

        $error= validator::make($request->all(),$rules);
        if($error->fails())
        {
    	    return response()->json(['errors'=>$error->errors()->all()]);
        }

        Blogs::where('id',$request->id)->delete();
        return redirect ('/blogs')->with('status',"you have Succesfully delete blog");
    }
}