<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
            Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->text('topic');
            $table->text('category');
            $table->longText('liked_by');
            $table->longText('winners');
            $table->longText('loosers');
            $table->integer('correct_ans');
            $table->integer('incorrect_ans');      
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
         Schema::drop('topics');
    }
}
