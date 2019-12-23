<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    protected $table="quiz_answer";

    public function users()
    {
    	return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function quizs()
    {
    	return $this->hasOne('App\Quiz', 'quiz_id', 'quiz_id');
    }
}
