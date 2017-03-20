<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJurnal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('contragent');
            $table->string('sklad');
            $table->string('operation');
            $table->decimal('cena_in',10,2);
            $table->decimal('cena_out',10,2);
            $table->integer('priznak');
            $table->integer('kol');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jurnals');
    }
}
