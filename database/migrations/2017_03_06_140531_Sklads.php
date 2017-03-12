<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sklads extends Migration
{
  
    public function up()
    {
        Schema::create('sklads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });
    }

  

    public function down()
    {
        Schema::drop('sklads');
    }
}
