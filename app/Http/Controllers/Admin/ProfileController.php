<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use Auth;
use Session;
use Redirect;
use Hash;

/**
 * Class ProfileController
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //Get item by ID
        $user = App\Admin::find(Auth::guard('admin')->user()->id);

        return view('admin.profile.index', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(){

        $user = App\Admin::find(Auth::guard('admin')->user()->id);

        return view('admin.profile.edit', ['user' => $user]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request){

        $update = App\Admin::find(Auth::guard('admin')->user()->id);

        $update->name=$request->input('name');
        $update->email=$request->input('email');


        if($update->save()){
            Session::flash('message', 'Profile updated successfully');
            Session::flash('message_type', 'success');
            return redirect::to('/admin/profile');
        }
        else {
            Session::flash('message', 'Error while updating profile');
            Session::flash('message_type', 'danger');
            return redirect::to('/admin/profile');


        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editPassword(){

        return view('admin.profile.password');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function updatePassword(Request $request){

        $update = App\Admin::find(Auth::guard('admin')->user()->id);
        $update->password = Hash::make($request->password);

        if($update->save()){
            Session::flash('message', 'Password updated successfully');
            Session::flash('message_type', 'success');
            return redirect::to('/admin/profile');
        }
        else{
            Session::flash('message', 'Error while updating');
            Session::flash('message_type', 'danger');
            return redirect::to('/admin/profile');
        }

    }


}
