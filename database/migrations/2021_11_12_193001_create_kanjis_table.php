<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKanjisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kanjis', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->string('kanji');
            $table->string('on_lesung');
            $table->string('kun_lesung');
            $table->string('bedeutung');
            $table->integer('rank');
            $table->integer('points');
            $table->string('timestamp');
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kanjis');
    }
}
