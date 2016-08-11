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
use Datatables;

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


        return view('admin.items.index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getItemsAjax()
    {

        $items = App\Models\Item::
        join('users', 'items.user_id', '=', 'users.id')
            ->join('categories', 'items.category_id', '=', 'categories.id')
            ->select(['items.id', 'items.name', 'users.name as author', 'categories.name as category', 'items.image', 'items.created_at'])
            ->orderBy('created_at', 'desc');




        return Datatables::of($items)
            ->addColumn('action', function ($item) {
            return '<a href="items/edit/'.$item->id.'"><i class="fa fa-pencil" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" title="Edit Item" data-placement="top" title="Edit Item"></i></a>
                    <a data-href="'.route('admin.items.destroy', $item->id) .'" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-ban" data-toggle="tooltip" data-placement="top" data-toggle="tooltip" data-placement="top" title="Delete " title="Delete Item"></i></a>';
        })
        ->editColumn(
            'image', function ($item) {
            if(($item->image != null) ||($item->image != "")) {

                return "<img class=\"lazy img-responsive\" src=\"../$item->image \" width=\"150\" alt=\"$item->name\">";
            }
            else {
                return "<img class=\"lazy img-responsive\" src=\"../../public/images/no-image.png\" alt=\"$item->name\" width=\"150\">";
            }

        })
            ->editColumn('created_at', function ($item) {
                return $item->created_at->format('d.m.Y');
            })
            ->make(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id){

        if(!$delete = App\Models\Item::find($id)) {
            abort(404);
        }


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

        if(!$items = App\Models\Item::find($id)) {
            abort(404);
        }


        return view('admin.items.edit', ['items' => $items]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id){

        if(!$update = App\Models\Item::find($id)) {
            abort(404);
        }

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
