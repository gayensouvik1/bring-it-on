<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->text('topic');
            $table->text('category');
            $table->longText('question');
            $table->text('option1');
            $table->text('option2');
            $table->text('option3');
            $table->text('option4');     
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
         Schema::drop('questions');

    }
}
