<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;
use Request;
use OpenGraph;
use Twitter;
use SEOMeta;
use Redis;


class HomepageController extends Controller
{

    public function __construct(){
        $this->middleware('web');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        //SEO
        SEOMeta::setDescription('This is page description');
        SEOMeta::setCanonical(Request::url());
       

        //Open Graph
        OpenGraph::setDescription('This is my page description');
        OpenGraph::setTitle('Homepage');
        OpenGraph::setUrl(Request::url());
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addImage('public/images/logo.png', ['height' => 300, 'width' => 300]);

        //Twitter
        Twitter::setTitle('Homepage');
        

        //Get items for homepage
        $items = App\Models\Item::take(20)->paginate(30);
        //$user = Redis::get('user:profile:');

        return view('frontend.homepage.index', ['items' => $items]);
    }
}
