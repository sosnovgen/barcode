<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedDetals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jurnal_id');
            $table->string('title');
            $table->decimal('cena',10,2);
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
        //
    }
}
