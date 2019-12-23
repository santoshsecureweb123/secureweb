<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\QuizAnswer;

class UserController extends Controller
{
    public function dashboard()
    {
    	$quiz = QuizAnswer::with(['users','quizs'])->get();  
		  $data = array();
    	foreach ($quiz as $key => $value) {
    		$data[] = array(
    			'userId' => $value->users->id,
    			'quizId' => $value->quiz_id,
    			'name' => $value->users->name,
    			'image' => $value->users->image,
    			'quiz_name' => $value->quizs->quiz_name,
    			'percentage' => ($value->trueAnswer/$value->totalQuestion)*100
    		);
    	}
    	$result = $final_Data = array();
			foreach ($data as $element) {
				if(@$result[$element['userId']][$element['quizId']]){
					if($result[$element['userId']][$element['quizId']][0]['percentage'] < $element['percentage'] ){
						$result[$element['userId']][$element['quizId']][0] = $element;
					}
				}else{
						$result[$element['userId']][$element['quizId']][0] = $element;
				}
			}
			foreach ($result as $array) {
				foreach ($array as $values) {
					foreach ($values as $value) {
						$final_Data[] = $value;
					}
				}
			}
 	 		foreach ($final_Data as $key => $row){
          $short_arr[$key] = $row['percentage'];
        }
    	array_multisort($short_arr, SORT_DESC, $final_Data);
    	return view('user.user.dashboard',compact('final_Data'));
    }
}
