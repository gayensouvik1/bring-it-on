<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('status');
            $table->string('topic');
            $table->integer('current_score');
            $table->longText('opponents');         
            $table->longText('my_scores');
            $table->longText('topics');
            $table->longText('questions_to_play');
            $table->longText('opponent_scores');
            $table->integer('updated_at');
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
         Schema::drop('infos');

    }
}
