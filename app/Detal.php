<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detal extends Model
{
    public $timestamps = false;
   
    protected $fillable = ['title','jurnal_id','kol', 'cena'];
    protected $attributes = array (
        'kol' => '1',
        'cena' => 0,

    );

    public function jurnal()
    {
        return $this->belongsTo('App\Jurnal', 'jurnal_id');
    }    
    
}
