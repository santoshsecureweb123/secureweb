<?php

namespace App\Http\Controllers\superAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\RoleStatus;

class AddRoleController extends Controller
{
	// add role page 
   public function add_role(){
 		return view('super-admin.super-admin.add_role');
   }

   //  add new role 
   public function addNewRole(Request $request){	
   		$role = new Role();
       	$role->role_name = request('role_name');
        	$role->save();
        	return redirect('add_role');
   }

    public function roleManagementView(){ 

      $role = Role::pluck('role_id','role_name');
      // echo "<pre>"; print_r($role); exit;
      $admin = $role['Admin'];
      $manager = $role['Manager'];
      $user = $role['User'];
      $teamlead = $role['Team Leader (TL)'];

      return view('super-admin.role_status.roleManagementView',compact('admin','manager','user','teamlead'));
    }

    public function roleManagement(Request $request){

      $role_id = request('rol_id');
      $getold = RoleStatus::where('role_id',$role_id)->first();
      $add = request('add');
      $edit = request('edit');
      $delete = request('Delete');
        if($getold == ''){
          $rolestatus = new RoleStatus();
          $rolestatus->role_id = $role_id;
          $rolestatus->add = $add;
          $rolestatus->edit = $edit;
          $rolestatus->delete = $delete;
          $rolestatus->save();
          return response(['success'=>true]);
        }
        else
        {
          $getskill = RoleStatus::where('role_id',$role_id)->update(['add' => $add,'edit'=>$edit,'delete'=>$delete]);
          return response(['success'=>true]);
        }

    }
   
}
