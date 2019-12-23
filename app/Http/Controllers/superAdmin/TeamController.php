<?php

namespace App\Http\Controllers\superAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Team;

class TeamController extends Controller
{
    public function createTeamView()
    {
    	$teams = Team::select('team_manager_id','team_lead_id','team_member_id')->get();
    	foreach ($teams as $values) {
    			$data[] = $values->team_manager_id;
    			$data[] = $values->team_lead_id;
    			$data[] = $values->team_member_id;
    	}
    	$assignUser = explode(",",implode(",",$data));
    	$teamleader = User::where('role_id','4')->get();
    	$teamMember = User::where('role_id','3')->get();
    	$teamManager = User::where('role_id','2')->get();
    	$user_id = session()->get('user_id');
    	$role_id = session()->get('role_id');
			return view('super-admin.team.add_new_team',compact('teamleader','teamMember','teamManager','role_id','user_id','assignUser'));
    }

    public function createTeam(Request $request)
    {
    	
    	$teamId = request('team_id');
    	
    	if(isset($teamId) &&  $teamId != ''){
	    	$validator = Validator::make($request->all(),[
			    'team_name' => 'required',
			    'team_lead' => 'required',
			    'team_member' => 'required',
			    'team_manager' => 'required',
				]);
			}
			else
			{
				$validator = Validator::make($request->all(),[
			    'team_name' => 'required|unique:team',
			    'team_lead' => 'required',
			    'team_member' => 'required',
			    'team_manager' => 'required',
				]);
			}
    	if(!$validator->fails()) {
	    	
	    	if(isset($teamId) &&  $teamId != ''){

  		    $teamUpdate = Team::where('team_id',$teamId)->update(['team_name' => request('team_name'),'team_manager_id'=> request('team_manager'),'team_lead_id'=>request('team_lead'),'team_member_id'=>implode(",", request('team_member'))]);
             return redirect::back()->with('success', 'Team Update succesfully');
	    	}
	    	else
	    	{
		    	$team = new Team();
		    	$team->team_name = request('team_name');
		    	$team->author_id = request('author_id');
		    	$team->author_role_id = request('author_role_id');
		    	$team->team_lead_id = request('team_lead');
		    	$team->team_manager_id = request('team_manager');
		    	$team->team_member_id = implode(',',request('team_member'));
		    	$team->save();
		    	return redirect('allteam')::with('success', 'Team Created succesfully');
		    }
    	}
    	else
    	{
    		return Redirect::back()->withErrors($validator)->withInput($request->input());
    	}
    }

  public function allteam()
  {
  	$teams = Team::get();
  	$teamsMemID = Team::select('team_manager_id','team_lead_id','team_member_id')->get();
    	foreach ($teamsMemID as $values) {
    			$data[] = $values->team_manager_id;
    			$data[] = $values->team_lead_id;
    			$data[] = $values->team_member_id;
    	}
    	$assignUser = explode(",",implode(",",$data));
    	$teamleader = User::where('role_id','4')->get();
    	$teamMembers = User::where('role_id','3')->get();
    	$teamManager = User::where('role_id','2')->get();
  	return view('super-admin.team.allteam',compact('teamleader','teamMembers','teamManager','teams','assignUser'));
  }

  public function editTeam()
  {
  	$teamID = request('teamId');
  	$teams = Team::where('team_id',$teamID)->first();
  	$teamAll = Team::get();
  	
  	foreach ($teamAll as  $value) {
  		$data[]=$value->team_manager_id;
  		$data[]=$value->team_lead_id;
  		$data[]=$value->team_member_id;
  	}
  	$allUsed = explode(",",implode(",", $data));
  	$team_member = explode(",",$teams->team_member_id);
  	return response(['success'=>true,'team_id'=>$teams->team_id, 'team_name' => $teams->team_name,'team_manager'=>$teams->team_manager_id,'team_lead'=>$teams->team_lead_id,'team_member'=>$team_member,'allUsed'=>$allUsed]);
  }

  public function deleteTeam()
    {
    	$teamId = request('teamId'); 
      $success = Team::where('team_id',$teamId)->delete();
        return response(['success'=>true]);
    } 
}
