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


class ItemsController extends Controller
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
        $items = App\Models\Item::all();

        return view('admin.items.index', ['items' => $items]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id){

        $delete = App\Models\Item::find($id);

        if ($delete->delete()) {
            Session::flash('message', 'File deleted successfully');
            Session::flash('message_type', 'success');
            return redirect::to('/admin/items');
        } else {
            Session::flash('message', 'Error while deleting file');
            Session::flash('message_type', 'danger');
            return redirect::to('/admin/items');

        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id){

        $items = App\Models\Item::find($id);

        return view('admin.items.edit', ['items' => $items]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id){

        
        $update = App\Models\Item::find($id);
        $update->name = $request->input('name');
        $update->category_id = $request->input('category');
        $update->ingredients = $request->input('ingredients');
        $update->content = $request->input('directions');
        $update->time = $request->input('time');

        if ($request->hasFile('file')) {

            $file_name = substr(md5(uniqid(rand(), true)), 0, 100) . '.' . $request->file('file')->getClientOriginalExtension();
            $file_path = 'public/uploads/' . $file_name;

            $request->file('file')->move(
                base_path() . '/public/uploads/', $file_name
            );


            $update->image = $file_path;


        }


        if($update->save())
        {
            Session::flash('message', 'Sve ok');
            Session::flash('message_type', 'success');
            return redirect::to('/admin/items');


        }
        else{
            Session::flash('message', 'Error while updating profile');
            Session::flash('message_type', 'danger');
            return redirect::to('/admin/items');
        }

    }



}
