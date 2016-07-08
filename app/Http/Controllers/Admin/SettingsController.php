<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use Session;
use Redirect;
use App\Models;
use Settings;




class SettingsController extends Controller
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
        //Get settings
        $setting_google_analytics = Settings::get('google_analytics');
        return view('admin.settings.index',['setting_google_analytics' => $setting_google_analytics]);
    }

    public function store(Request $request) {

        //Save settings
        $google_analytics = $request->input('google_analytics');
        Settings::set('google_analytics', $google_analytics);
        Settings::save();

        Session::flash('message', 'Settings saved successfuly');
        Session::flash('message_type', 'success');
        return redirect::to('/admin/settings');
    }
}
