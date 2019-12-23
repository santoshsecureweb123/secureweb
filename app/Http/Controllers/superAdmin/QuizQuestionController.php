<?php

namespace App\Http\Controllers\superAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Skill;
use App\QuizQuestion;

class QuizQuestionController extends Controller
{
   public function addQuestionView()
    {
    	$skills = Skill::get();
    	$user_id = session()->get('user_id');
    	$role_id = session()->get('role_id');
    	return view('super-admin.question.addQuestion',compact('role_id','user_id','skills'));
    }

    public function addQuestion(Request $request)
    {
    	$validator = Validator::make($request->all(),[
			    // 'skill_name' => 'required',
			    'ques_name' => 'required',
			    'option_value' => 'required',
			    'option.*' => 'required',
			    'correct_answer' => 'required',
				]);
    	if(!$validator->fails()) {
    			$questionID = request('question_id');	
    			if(isset($questionID) &&  $questionID != "")
    			{
    				 $quesUpdate = QuizQuestion::where('question_id',$questionID)->update(['question_name' => request('ques_name'),'option'=>json_encode(request('option')),'answer'=>request('correct_answer')]);
             return redirect::back()->with('success', 'Team Update succesfully');
    			}
    			else
    			{    				
	   			 	$quizQuestion	= new QuizQuestion();
	   			 	$quizQuestion->question_name=request('ques_name');
	   			 	$quizQuestion->author_id=request('author_id');
	   			 	$quizQuestion->author_role_id=request('author_role_id');
	   			 	$quizQuestion->skill_id=request('skill_name');
            $quizQuestion->quiz_id=request('quiz_id');
	   			 	$quizQuestion->option=json_encode(request('option'));
	   			 	$quizQuestion->answer=request('correct_answer');
	   			 	$quizQuestion->save();
	   			 	return redirect::back()->with('success', 'Question insert succesfully');
   			 }
     	}
    	else
    	{
    		return Redirect::back()->withErrors($validator)->withInput($request->input());
    	}
    }

    public function allQuestion()
    {
      $quizID = request('id');
      $skill_id = request('skill');
    	$skills = Skill::get();
      $user_id = session()->get('user_id');
      $role_id = session()->get('role_id');
    	$allQuestions = QuizQuestion::where('quiz_id',$quizID)->get();
    	return view('super-admin.question.allQuestion',compact('allQuestions','skills','quizID','user_id','role_id','skill_id'));
    }

    public function editQuestion()
    {
    	$quesID = request('quesId');	
			$quiz = QuizQuestion::where('question_id',$quesID)->first();
			return response(['success'=>true,'question_id'=>$quiz->question_id, 'question_name' => $quiz->question_name,'skill_id'=>$quiz->skill_id,'option'=>$quiz->option,'answer'=>$quiz->answer]);
    }

    public function deleteQuestion()
    {
    	$quesId = request('quesId'); 
      $success = QuizQuestion::where('question_id',$quesId)->delete();
        return response(['success'=>true]);
    } 
}
