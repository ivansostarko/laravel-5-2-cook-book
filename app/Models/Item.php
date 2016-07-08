<?php

namespace App\Models;


use Sofa\Eloquence\Eloquence;
use Illuminate\Database\Eloquent\Model;



class Item extends Model
{

    use Eloquence;

    
   protected $table = 'items';

    public $fillable = ['name', 'category_id ', 'user_id', 'image', 'content', 'ingredients', 'time'];

    protected $searchableColumns = ['name', 'content','ingredients', 'time' ];

   public function users()
    {
      return $this->belongsTo('App\User', 'user_id');
    }

    public function categories()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}
