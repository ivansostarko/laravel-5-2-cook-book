<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use Session;
use Redirect;
use App\Models;
use Spatie\Activitylog\Models\Activity;



class ActivitiesController extends Controller
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
        //Get number of users
        $activities = Activity::with('user')->latest()->limit(100)->get();



        return view('admin.activities.index',['activities' => $activities]);
    }

    public function clear() {
        Activity::getQuery()->delete();
        Session::flash('message', 'Log clear successfuly');
        Session::flash('message_type', 'success');
        return redirect::to('/admin/activities');
    }
}
