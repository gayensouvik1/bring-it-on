<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('new_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->text('topic');
            $table->text('category');
            $table->longText('question');
            $table->text('option1');
            $table->text('option2');
            $table->text('option3');
            $table->text('option4');     
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
         Schema::drop('new_questions');
    }
}
?>