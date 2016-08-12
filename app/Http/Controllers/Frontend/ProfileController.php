<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use Auth;
use Session;
use Redirect;
use Hash;
use App\Helpers\SendMail;


  class ProfileController extends Controller
  {


      public function __construct(){
          $this->middleware('auth');
      }


      /**
       * Display a listing of the resource.
       *
       * @return Response
       */
      public function index()
      {
          //Get item by ID
          $user = App\User::find(Auth::user()->id);

          return view('frontend.profile.index', ['user' => $user]);
      }

      /**
       * Show the form for editing the specified resource.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit(){

          $user = App\User::find(Auth::user()->id);

          return view('frontend.profile.edit', ['user' => $user]);

      }
      /**
       * Update the specified resource in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update(Request $request){

          $update = App\User::find(Auth::user()->id);

          $update->name=$request->input('name');
          $update->email=$request->input('email');


          if($update->save()){
              Session::flash('message', 'Profile updated successfully');
              Session::flash('message_type', 'success');
              return redirect::to('/profile');
          }
          else {
              Session::flash('message', 'Error while updating profile');
              Session::flash('message_type', 'danger');
              return redirect::to('/profile');

              return redirect::to('/profile');
          }

      }

      public function editPassword(){

          return view('frontend.profile.password');

      }

      public function updatePassword(Request $request){

          $update = App\User::find(Auth::user()->id);
          $update->password = Hash::make($request->password);

          //Get user email for sending mail
          $email = App\User::select('email')->where('id',Auth::user()->id)->first();

          if($update->save()){
              SendMail::send_user_password($email['email']);
              Session::flash('message', 'Password updated successfully');
              Session::flash('message_type', 'success');
              return redirect::to('/profile');
          }
          else{
              Session::flash('message', 'Error while updating password');
              Session::flash('message_type', 'danger');
              return redirect::to('/profile');
          }

      }


  }
