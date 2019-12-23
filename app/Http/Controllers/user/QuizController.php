<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Quiz;
use App\QuizQuestion;
use App\QuizAnswer;
use Session;

class QuizController extends Controller
{
    public function allQuiz()
    {
    	$role_id = session()->get('role_id');
    	$user_id = session()->get('user_id');
    	$skills_id = User::where('id',$user_id)->get('skills')->first();
    	$skills_id = $skills_id->skills;
    	$skills_id = explode(',', $skills_id);
    	$quizs = Quiz::whereIn('skill_id',$skills_id)->get();
    	return view('user.quiz.allQuiz',compact('quizs'));
    }

    public function QuizStart()
    {
    	$quizID = request('id');
    	$user_id = session()->get('user_id');
    	$allQuestions = QuizQuestion::where('quiz_id',$quizID)->get();
    	return view('user.quiz.startQuiz',compact('allQuestions','quizID',"user_id"));
    }
    public function quizAnswer(Request $request)
    {
    	$result = $request->all();
    	$quizID = request('quiz_id');
    	$user_id = request('user_id');
    	unset($result['_token']);
    	unset($result['quiz_id']);
    	unset($result['user_id']);
    	$data = array();
    	foreach ($result as $Rkey => $value) {
    		$Rkey = str_replace('answer_',"", $Rkey);
    		$data[$Rkey] = $value;
    	}
    	$allQuestions = QuizQuestion::where('quiz_id',$quizID)->get();
    	foreach ($allQuestions as $Qkey => $values) {
    		$QuesCheck[$values->question_id] = $values->answer;
    	}
    	$totalQuestion = count($QuesCheck);
    	$falseAnswer = $trueanswer = 0;

    	foreach ($QuesCheck as $Ckey => $value) {
    		if (array_key_exists($Ckey,$data)){
				  	if($data[$Ckey] === $value){
				  		$trueanswer++;
				  	}
				  	else{
				  		$falseAnswer++;
				  	}
				}
				else {
				  $falseAnswer++;
				}
    	}

    	$quizAnswer = new QuizAnswer();
    	$quizAnswer->quiz_id = $quizID;
    	$quizAnswer->user_id = $user_id;
    	$quizAnswer->totalQuestion = $totalQuestion;
    	$quizAnswer->trueAnswer = $trueanswer;
    	$quizAnswer->falseAnswer = $falseAnswer;
    	$quizAnswer->save();
    	Session::flash('success', "Quiz Attempt Successfully");
    	return redirect('allQuiz');
    }
}
