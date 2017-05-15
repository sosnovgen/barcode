<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $fillable = ['contragent','sklad', 'operation', 'sum','priznak'];
    protected $attributes = array (
        'priznak' => '0',
        'sum' => '0',

    );
}
