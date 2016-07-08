<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use App\Models;
use Online;

use Carbon\Carbon;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
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
        $get_users = App\User::all()->count();

        //Get number of admins
        $get_admins = App\Admin::all()->count();

        //Get number of categories
        $get_categories = App\Models\Category::all()->count();

        //Get number of items
        $get_items = App\Models\Item::all()->count();

        //Get number of banned users
        $get_banned = App\User::where('banned', 1)->count();

        //Get count of unverified users
        $get_unverified = App\User::where('verified', 0)->count();

        //Get count of online guests
        $get_online_guests =  Online::guests()->count();

        //Get count of online users
        $get_online_users = Online::users()->count();

        //Get latest users
        $latest_users = Online::users()->limit(15)->get();

       
        return view('admin.dashboard.index',
            ['users' => $get_users,
                'admins' => $get_admins,
                'categories' => $get_categories,
                'items' => $get_items,
                'banned' => $get_banned,
                'unverified' => $get_unverified,
                'get_online_guests' => $get_online_guests,
                'get_online_users' => $get_online_users,
                'latest_users' => $latest_users
            ]);
    }
}
