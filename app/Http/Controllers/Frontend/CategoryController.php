<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use Illuminate\Support\Facades\Route;
use OpenGraph;
use Twitter;
use SEOMeta;


class CategoryController extends Controller
{


    public function __construct(){
        $this->middleware('web');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        //Get item by ID
        $items = App\Models\Item::where('category_id', '=', $id)->orderBy('created_at', 'desc')->paginate(15);
        $category = App\Models\Category::find($id);

        //SEO
        SEOMeta::setDescription('This is my page description');
        SEOMeta::setCanonical(\Request::url());


        //Open Graph
        OpenGraph::setDescription('This is my page description');
        OpenGraph::setTitle($category->name);
        OpenGraph::setUrl(\Request::url());
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addImage('public/images/logo.png', ['height' => 300, 'width' => 300]);

        //Twitter
        Twitter::setTitle($category->name);



        return view('frontend.category.index', ['items' => $items, 'category' => $category]);
    }
}
