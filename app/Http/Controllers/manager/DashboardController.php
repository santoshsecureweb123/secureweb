<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Charts;
use App\Skill;
use App\User;

class DashboardController extends Controller
{
    public function dashboard(){

    	$getskill = User::pluck('skills');
		$data = array();
    	foreach ($getskill as $key => $value) {
    		$data[] = $value;
    	}
    	$total = explode(",",implode(',',$data));
		$total = array_count_values($total);
    	$nodejs = (isset($total[1]))?$total[1]:'0';
    	$php = (isset($total[2]))?$total[2]:'0';
    	$angular = (isset($total[3]))?$total[3]:'0';
    	$chart = Charts::create('bar', 'highcharts')
            ->title('Skill Graph')
            ->labels(['Node js', 'Php','Angular'])
            ->values([$nodejs,$php,$angular]);
            return view('manager.manager.dashboard',compact('chart'));
    }
   
}
