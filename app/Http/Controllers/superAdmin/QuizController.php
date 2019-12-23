<?php

namespace App\Http\Controllers\superAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Skill;
use App\Quiz;
use App\QuizQuestion;

class QuizController extends Controller
{
 	public function addQuizView()   
 	{
		$skills = Skill::get();
		$user_id = session()->get('user_id');
		$role_id = session()->get('role_id');
		return view('super-admin.quiz.addQuiz',compact('role_id','user_id','skills'));
 	}

 	public function allQuiz()
 	{
 		$skills = Skill::get();
    $allQuizs = Quiz::get();
    $user_id = session()->get('user_id');
    $role_id = session()->get('role_id');
    return view('super-admin.quiz.allQuiz',compact('allQuizs','skills','user_id','role_id'));
 	}

 	public function addQuiz(Request $request)
    { 
    	// echo "<pre>"; print_r($_POST); exit;
    	$validator = Validator::make($request->all(),[
			    'skill_name' => 'required',
			    'quiz_name' => 'required',			    
				]);
    	if(!$validator->fails()) {
    			$quiz_id = request('quiz_id');	
    			if(isset($quiz_id) &&  $quiz_id != "")
    			{
    				 $quizUpdate = Quiz::where('quiz_id',$quiz_id)->update(['quiz_name' => request('quiz_name'),'skill_id'=> request('skill_name')]);
             return redirect::back()->with('success', 'Team Update succesfully');
    			}
    			else
    			{    				
	   			 	$quiz	= new Quiz();
	   			 	$quiz->quiz_name=request('quiz_name');
	   			 	$quiz->author_id=request('author_id');
	   			 	$quiz->author_role_id=request('author_role_id');
	   			 	$quiz->skill_id=request('skill_name');
	   			 	$quiz->save();
	   			 	return redirect::back()->with('success', 'Question insert succesfully');
   			 }
     	}
    	else
    	{
    		return Redirect::back()->withErrors($validator)->withInput($request->input());
    	}
    }

   public function editQuiz()
    {
    	$quizId = request('quizId');	
			$quiz = Quiz::where('quiz_id',$quizId)->first();
			return response(['success'=>true,'quiz_id'=>$quiz->quiz_id, 'quiz_name' => $quiz->quiz_name,'skill_id'=>$quiz->skill_id]);
    }
    
    public function deleteQuiz()
    {
    	$quizId = request('quizId'); 
      $success = Quiz::where('quiz_id',$quizId)->delete();
        return response(['success'=>true]);
    } 

}
