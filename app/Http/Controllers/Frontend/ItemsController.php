<?php

namespace App\Http\Controllers\Frontend;

use App;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use Image;
use Redirect;
use Session;
use Activity;

use OpenGraph;
use Twitter;
use SEOMeta;



/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class ItemsController extends Controller
{

    public function __construct(){
        //$this->middleware('auth');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        if(!$item = App\Models\Item::find($id)) {
            abort(404);
        }

        //SEO
        SEOMeta::setDescription(str_limit($item->content, $limit = 180, $end = '...'));
        SEOMeta::setCanonical(\Request::url());


        //Open Graph
        OpenGraph::setDescription(str_limit($item->content, $limit = 180, $end = '...'));
        OpenGraph::setTitle($item->name);
        OpenGraph::setUrl(\Request::url());
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addImage($item->image, ['height' => 300, 'width' => 300]);

        //Twitter
        Twitter::setTitle($item->name);

        return view('frontend.items.show', ['item' => $item]);
    }


    /**
     * Display the specified resource.
     *
     * @param Request|string
     * @return Response
     */
    public function search(Request $request)
    {

        $query = \Request::input('search');

        #https://github.com/jarektkaczyk/eloquence/wiki/Builder-searchable-and-more
        $items =  App\Models\Item::search($query)->orderBy('created_at', 'desc')->get();


        //SEO
        SEOMeta::setDescription('Search results for' . $query);
        SEOMeta::setCanonical(\Request::url());


        //Open Graph
        OpenGraph::setDescription('This is my page description' . $query);
        OpenGraph::setTitle($query);
        OpenGraph::setUrl(\Request::url());
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addImage('public/images/logo.png', ['height' => 300, 'width' => 300]);

        //Twitter
        Twitter::setTitle($query);

        return view('frontend.items.search', ['items' => $items, 'query' => $query]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $items = App\Models\Item::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return view('frontend.items.index', ['items' => $items]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        $delete = App\Models\Item::find($id);
        if ($delete->delete()) {
            Session::flash('message', 'File deleted successfully');
            Session::flash('message_type', 'success');
            return redirect::to('/items');
        } else {
            Session::flash('message', 'Error while deleting file');
            Session::flash('message_type', 'danger');
            return redirect::to('/items');

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $categories = App\Models\Category::all();

        return view('frontend.items.create', ['categories' => $categories]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $user_id = Auth::user()->id;

        $item = new App\Models\Item;
        $item->name = $request->input('name');
        $item->category_id = $request->input('category');
        $item->user_id = $user_id;
        $item->ingredients = $request->input('ingredients');
        $item->content = $request->input('directions');
        $item->time = $request->input('time');

        if ($request->hasFile('file')) {

            $file_name = substr(md5(uniqid(rand(), true)), 0, 100) . '.' . $request->file('file')->getClientOriginalExtension();
            $file_path = 'public/uploads/' . $file_name;

            $request->file('file')->move(
                base_path() . '/public/uploads/', $file_name
            );


            $item->image = $file_path;


        }


        if($item->save())
        {
            //Log Activity
            Activity::log('User created Item');

            Session::flash('message', 'Sve ok');
            Session::flash('message_type', 'success');
            return redirect::to('/items');


        }
        else{
            Session::flash('message', 'Error while updating profile');
            Session::flash('message_type', 'danger');
            return redirect::to('/items');
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {

        $items = App\Models\Item::find($id);
        $categories = App\Models\Category::all();

        return view('frontend.items.edit', ['items' => $items, 'categories' => $categories]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

        $item = App\Models\Item::find($id);
        $item->name = $request->input('name');
        $item->category_id = $request->input('category');
        $item->ingredients = $request->input('ingredients');
        $item->content = $request->input('directions');
        $item->time = $request->input('time');

        if ($request->hasFile('file')) {

            $file_name = substr(md5(uniqid(rand(), true)), 0, 100) . '.' . $request->file('file')->getClientOriginalExtension();
            $file_path = 'public/uploads/' . $file_name;

            $request->file('file')->move(
                base_path() . '/public/uploads/', $file_name
            );


            $item->image = $file_path;


        }


        if($item->save())
        {
            Session::flash('message', 'Sve ok');
            Session::flash('message_type', 'success');
            return redirect::to('/items');


        }
        else{
            Session::flash('message', 'Error while updating profile');
            Session::flash('message_type', 'danger');
            return redirect::to('/items');
        }


    }
}
