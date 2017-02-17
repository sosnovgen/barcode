<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atribute extends Model
{
    protected $fillable = ['article_id','category_id','key','value'];


    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function article()
    {
        return $this->belongsTo('App\Article', 'article_id');
    }

}