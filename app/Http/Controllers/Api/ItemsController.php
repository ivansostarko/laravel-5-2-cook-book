<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use App\Models;
use App\Helpers;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Illuminate\Http\Response as HttpResponse;




class ItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function getItem($id)
    {
        //Return all categories for homepage view in Ionic App
        $item = App\Models\Item::select('name', 'image', 'content', 'ingredients', 'time', 'created_at')
            ->where('id', $id)
            ->with('users')
            ->with('categories')
            ->get();

        //If record exist
        if ($item->first()) {

            return ResponseBuilder::success($item);
        }
        else {
            $message = "Data not found";
            return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_404, $message);
        }


    }

    public function getSearch($query)
    {
        //Return all categories for homepage view in Ionic App
        $items =  App\Models\Item::search($query)->get();

        //If record exist
        if ($items->first()) {

            return ResponseBuilder::success($items);
        }
        else {
            $message = "Search result not found";
            return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_404, $message);
        }


    }
    
    
    

}
