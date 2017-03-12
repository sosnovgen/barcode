<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contragent extends Model
{
    protected $fillable = ['title', 'group', 'note', 'priznak'];
    protected $attributes = ['priznak' => '0'];


}
