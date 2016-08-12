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
use Validator;


class CategoriesController extends Controller
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
        $categories = App\Models\Category::orderBy('created_at', 'desc')->get();

        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $save = new App\Models\Category;

        $save->name=$request->input('name');

        if ($request->hasFile('file')) {

            $file_name = substr(md5(uniqid(rand(), true)), 0, 100) . '.' . $request->file('file')->getClientOriginalExtension();
            $file_path = 'public/uploads/' . $file_name;

            $request->file('file')->move(
                base_path() . '/public/uploads/', $file_name
            );


            $save->image = $file_path;


        }

        if($save->save()){
            \Session::flash('message', 'Category created successfully.');
            \Session::flash('message_type', 'success');
            return redirect::to('/admin/categories');
        }
        else {
            \Session::flash('message', 'Error while creating category.');
            \Session::flash('message_type', 'danger');
            return redirect::to('/admin/categories');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id){

        if(!$delete = App\Models\Category::find($id)) {
            abort(404);
        }


        if ($delete->delete()) {
            Session::flash('message', 'Category deleted successfully');
            Session::flash('message_type', 'success');
            return redirect::to('/admin/categories');
        } else {
            Session::flash('message', 'Error while deleting category');
            Session::flash('message_type', 'danger');
            return redirect::to('/admin/categories');

        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id){

        if(!$category = App\Models\Category::find($id)) {
            abort(404);
        }


        return view('admin.categories.edit', ['category' => $category]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id){

        if(!$update = App\Models\Category::find($id)) {
            abort(404);
        }


        $update->name=$request->input('name');


        if ($request->hasFile('file')) {

            $file_name = substr(md5(uniqid(rand(), true)), 0, 100) . '.' . $request->file('file')->getClientOriginalExtension();
            $file_path = 'public/uploads/' . $file_name;

            $request->file('file')->move(
                base_path() . '/public/uploads/', $file_name
            );

            $update->image = $file_path;
            
        }


        if($update->save()){
            Session::flash('message', 'Category updated successfully');
            Session::flash('message_type', 'success');
            return redirect::to('/admin/categories');
        }
        else {
            Session::flash('message', 'Error while updating category');
            Session::flash('message_type', 'danger');
            return redirect::to('/admin/categories');

        }

    }



}
