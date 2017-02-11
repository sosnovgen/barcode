<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title','barcode', 'preview', 'content', 'category_id', 'group_id','cena_out', 'cena_in'];
    protected $attributes = array (
        'group_id' => '0',
        'cena_out' => 0,
        'cena_in' => 0,
    );
    
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id');
    }
    
}
