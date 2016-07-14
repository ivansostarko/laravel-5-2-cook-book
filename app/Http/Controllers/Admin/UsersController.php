<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\SendMail;
use App;
use Auth;
use Session;
use Redirect;
use Hash;
use Validator;
use Online;
use Spatie\Activitylog\Models\Activity;


class UsersController extends Controller
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

        $users = App\User::all();

         return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $save = new App\User;

        $save->name=$request->input('name');
        $save->email=$request->input('email');
        $save->password = Hash::make($request->password);
        $save->verified=1;
        $save->banned=0;


        if($save->save()){
            SendMail::send_welcome_mail($request->input('email'));
            Session::flash('message', 'User registred successfully');
            Session::flash('message_type', 'success');
            return redirect::to('/admin/users');
        }
        else {
            Session::flash('message', 'Error while saving admin');
            Session::flash('message_type', 'danger');
            return redirect::to('/admin/users');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id){


        if(!$delete = App\User::find($id)) {
            abort(404);
        }

        if ($delete->delete()) {
            Session::flash('message', 'File deleted successfully');
            Session::flash('message_type', 'success');
            return redirect::to('/admin/users');
        } else {
            Session::flash('message', 'Error while deleting file');
            Session::flash('message_type', 'danger');
            return redirect::to('/admin/users');

        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id){


        if(!$user = App\User::find($id)) {
            abort(404);
        }

        return view('admin.users.edit', ['user' => $user]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id){

        if(!$update = App\User::find($id)) {
            abort(404);
        }

        $update->name=$request->input('name');
        $update->email=$request->input('email');


        if($update->save()){
            Session::flash('message', 'Profile updated successfully');
            Session::flash('message_type', 'success');
            return redirect::to('/admin/users');
        }
        else {
            Session::flash('message', 'Error while updating profile');
            Session::flash('message_type', 'danger');
            return redirect::to('/admin/users');


        }

    }


    public function show($id){

        if(!$user = App\User::find($id)) {
            abort(404);
        }


        //Check if user is online
        $is_online = Online::where('user_id', $id)->count();

        //Get user activities
        $activities = Activity::where('user_id', $id)->latest()->limit(100)->get();

        return view('admin.users.show', ['user' => $user, 'is_online' => $is_online, 'activities' => $activities]);

    }


    public function editPassword($id){

        if(!$user = App\User::find($id)) {
            abort(404);
        }

        return view('admin.users.password', ['user' => $user]);

    }

    public function updatePassword(Request $request, $id){

        if(!$update = App\User::find($id)) {
            abort(404);
        }

        $update->password = Hash::make($request->password);

        if($update->save()){
            Session::flash('message', 'Password updated successfully');
            Session::flash('message_type', 'success');
            return redirect::to('/admin/users');
        }
        else{
            Session::flash('message', 'Error while updating');
            Session::flash('message_type', 'danger');
            return redirect::to('/admin/users');
        }

    }

    public function verify($id){

        if(!$update = App\User::find($id)) {
            abort(404);
        }

        $update->verified = 1;

        $email = App\User::select('email')->where('id', '=', $id)->first();


        if($update->save()){
            //Send email to user
            SendMail::send_admin_verify($email['email']);
            Session::flash('message', 'Verified');
            Session::flash('message_type', 'success');
            return redirect::to('/admin/users');
        }
        else{
            Session::flash('message', 'no Verified');
            Session::flash('message_type', 'danger');
            return redirect::to('/admin/users');
        }

    }

    public function ban($id){

        if(!$update = App\User::find($id)) {
            abort(404);
        }

        $update->banned = 1;

        $email = App\User::select('email')->where('id', '=', $id)->first();


        if($update->save()){
            //Send email to user
            SendMail::send_admin_ban($email['email']);
            Session::flash('message', 'Account banned successfuly');
            Session::flash('message_type', 'success');
            return redirect::to('/admin/users');
        }
        else{
            Session::flash('message', 'no banned problem');
            Session::flash('message_type', 'danger');
            return redirect::to('/admin/users');
        }

    }

    public function unban($id){

        if(!$update = App\User::find($id)) {
            abort(404);
        }

        $update->banned = 0;

        $email = App\User::select('email')->where('id', '=', $id)->first();


        if($update->save()){
            //Send email to user
            SendMail::send_admin_unban($email['email']);
            Session::flash('message', 'Account unbanned successfuly');
            Session::flash('message_type', 'success');
            return redirect::to('/admin/users');
        }
        else{
            Session::flash('message', 'no unbanned problem');
            Session::flash('message_type', 'danger');
            return redirect::to('/admin/users');
        }

    }
}
