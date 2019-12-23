<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table="quiz";

    public function quizAnswer()
    {
    	return $this->hasOne('App/QuizAnswer','quiz_id','quiz_id');
    }
    
}
