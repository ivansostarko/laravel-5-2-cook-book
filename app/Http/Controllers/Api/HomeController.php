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




class HomeController extends Controller
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
    public function index() {

        $data = ["Version" => "1.0"];
        return ResponseBuilder::success($data);
    }

    public function getCategories()
    {   
        //Return all categories for homepage view in Ionic App
        $categories = App\Models\Category::select('id', 'name', 'image')->get();

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
