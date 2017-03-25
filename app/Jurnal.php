<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $fillable = ['title','contragent','sklad', 'kol', 'operation', 'cena', 'priznak'];
    protected $attributes = array (
        'kol' => '1',
        'priznak' => '0',
        'cena' => 0,

    );
}
