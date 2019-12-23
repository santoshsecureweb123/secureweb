<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_answer', function (Blueprint $table) {
            $table->bigIncrements('ans_id');
            $table->integer('quiz_id');
            $table->integer('user_id');
            $table->integer('totalQuestion');
            $table->integer('trueAnswer');
            $table->integer('falseAnswer');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('quiz_answer');
    }
}
