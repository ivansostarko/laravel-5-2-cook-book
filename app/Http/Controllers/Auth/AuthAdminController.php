<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use Session;
use App;

class AuthAdminController extends Controller
{
    
    public function __construct(){
      $this->middleware('admin');
    }


    //Currently not in use
    public function getlogin(){
        return view('auth.login');
    }

    //Currently not in use
    public function postLogin(Request $request){

        $validator = validator($request->all(),[
            'email' => 'required|min:3|max:100',
            'password' => 'required|min:3|max:100',
        ]);

        if ($validator->fails()){
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];

        if ( auth()->guard('admin')->attempt($credentials) ){
            return redirect('/admin/dashboard');
        }else{
            return redirect('/login')
                ->withErrors(['errors' => 'Login Invalid'])
                ->withInput();
        }
    }


    //Admin logout
    public function logout(){
        auth()->guard('admin')->logout();
        Session::flash('message', 'Uspješno ste odjavljeni');
        Session::flash('message_type', 'success');
        return redirect ('/login');
        
    }

}
