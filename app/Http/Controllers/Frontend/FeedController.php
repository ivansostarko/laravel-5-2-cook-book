<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use Illuminate\Support\Facades\Route;


/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class FeedController extends Controller
{
    public function __construct(){
        $this->middleware('web');
    }
    

    public function index()
    {

        // create new feed
        $feed = App::make("feed");

        // multiple feeds are supported
        // if you are using caching you should set different cache keys for your feeds

        // cache the feed for 60 minutes (second parameter is optional)
       // $feed->setCache(60, 'laravelFeedKey');

        // check if there is cached feed and build new only if is not
        if (!$feed->isCached())
        {
            // creating rss feed with our most recent 20 posts
            $items = App\Models\Item::orderBy('created_at', 'desc')->take(20)->get();

            // set your feed's title, description, link, pubdate and language
            $feed->title = 'Recipes';
            $feed->description = 'Laravel App example';
            $feed->logo = '';
            $feed->link = url('feed');
            $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
            $feed->pubdate = $items[0]->created_at;
            $feed->lang = 'en';
            $feed->setShortening(true); // true or false
            $feed->setTextLimit(100); // maximum length of description text

            foreach ($items as $item)
            {
                // set item's title, author, url, pubdate, description, content, enclosure (optional)*
                $feed->add($item->name, $item->users->name, route('web.item', $item->id), $item->created_at, $item->content);
            }

        }

        // first param is the feed format
        // optional: second param is cache duration (value of 0 turns off caching)
        // optional: you can set custom cache key with 3rd param as string
        return $feed->render('atom');

        // to return your feed as a string set second param to -1
        // $xml = $feed->render('atom', -1);

    }
}
