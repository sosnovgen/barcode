<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArticlesChandgCena extends Migration
{
 
    public function up()
    {
        Schema::table('articles', function($table)
        {
            $table->decimal('cena',10,2)->change();
        });
    }

    public function down()
    {
        //
    }
}
