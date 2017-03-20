<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $fillable = ['title','contragent','sklad', 'kol', 'operation', 'cena_out', 'priznak', 'cena_in'];
    protected $attributes = array (
        'kol' => '1',
        'priznak' => '0',
        'cena_out' => 0,
        'cena_in' => 0,
    );
}
