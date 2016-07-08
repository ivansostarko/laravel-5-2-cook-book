<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;



class SitemapController extends Controller
{


    public function __construct(){
        $this->middleware('web');
    }
    
    public function index()
    {


        $items = App\Models\Item::all();

        foreach ($items as $item) {
            Sitemap::addTag(route('web.item', $item->id), $item->updated_at, 'daily', '0.8');
                   }

        return Sitemap::render();

    }
}
