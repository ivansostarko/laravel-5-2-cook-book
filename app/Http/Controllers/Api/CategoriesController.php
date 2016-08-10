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




class CategoriesController extends Controller
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

    public function getItems($id)
    {
        //Return all categories for homepage view in Ionic App
        $items = App\Models\Item::select('id', 'name', 'image', 'time')->where('category_id', $id)->get();

        //If record exist
        if ($items->first()) {

            return ResponseBuilder::success($items);
        }
        else {
            $message = "Data not found";
            return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_404, $message);
        }


    }

    public function getCategories()
    {
        //Return all categories for homepage view in Ionic App
        $categories = App\Models\Category::select('id', 'name')->get();

        //If record exist
        if ($categories->first()) {

            return ResponseBuilder::success($categories);
        }
        else {
            $message = "Data not found";
            return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_404, $message);
        }


    }



}
