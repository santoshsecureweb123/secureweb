<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Mail\UserRegister;
use Illuminate\Support\Facades\Mail;
use App\Skill;
use App\User;
use App\Role;
use App\RoleStatus;
use Hash;
use Auth;

class UserController extends Controller
{

    public function showUserForm()
    {
        $getskill = Skill::get();
        $getrole = Role::get();

        // echo "<pre>"; print_r($getrole); exit;

        return view('manager.user.addnewuser',compact('getskill','getrole'));
    }

    public function addNewUser(Request $request){
        $userid = request('user_id');
        if(isset($userid) &&  $userid != ''){
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required|email',
                'dob' => 'required|date',
                'address' => 'required',
                'role' => 'required',
                'phone_number' => 'required|min:10|numeric',
                'skills' => 'required',
                'experience' => 'required',
                'designation' => 'required',
            ]);
        } 
        else {
    	$validator = Validator::make($request->all(),[
			    'name' => 'required',
			    'email' => 'required|email',
			    'password' => 'required|min:5|max:15',
			    'dob' => 'required|date',
			    'address' => 'required',
			    'phone_number' => 'required|min:10|numeric',
                'role' => 'required',
			    'skills' => 'required',
			    'experience' => 'required',
			    'designation' => 'required',
			    'image' => 'required',
			]);
    	}
    	if(!$validator->fails()) {

            if(isset($userid) &&  $userid != ''){
               
                $newImage = request()->file('image');

                if(isset($newImage) && $newImage != "")
                {
                    $imageName = time().'.'.request()->image->getClientOriginalExtension();
                    request()->image->move(public_path('image'), $imageName);
                }
                else
                {
                    $imageName = request('old_img');
                }
                $getskill = User::where('id',$userid)->update(['name' => request('name'),'role_id'=>request('role'),'email'=> request('email'),'date_of_birth'=>request('dob'),'address'=>request('address'),'phone_no'=>request('phone_number'),'skills'=>implode(",", request('skills')),'experience'=>request('experience'),'designation'=>request('designation'),'image'=>$imageName]);
                 return redirect::back()->with('success', 'User Update succesfully');

            }            
            else{

    		/*$imageName = time().'.'.request()->image->getClientOriginalExtension();
        		request()->image->move(public_path('image'), $imageName);*/
    		$email = request('email');
    		$password = request('password');
    		$user = new User();
    		$user->name = request('name');
    		$user->email = request('email');
    		$user->date_of_birth = request('dob');
    		$user->address = request('address');
    		$user->phone_no = request('phone_number');
            $user->role_id = request('role');
    		$user->skills = implode(",", request('skills'));
    		$user->experience = request('experience');
    		$user->designation = request('designation');
    		$user->image = request('image');
    		$user->password = Hash::make(request('password'));
    		$user->save();

    		$data['email'] = $email;
    		$user['password'] = $password;

    		Mail::to($data['email'])->send(new UserRegister($user));

    		 return redirect::back()->with('success', 'User register succesfully');
            }
    	}
    	else{
            
    		return Redirect::back()->withErrors($validator)->withInput($request->input());
    	}
    }

    public function getAllUser()
    {
    	$getUser = User::where('role_id','!=','1')->get(); 
    	$getskill = Skill::get();
        $getrole = Role::get();
        $role_id = session()->get('role_id');
        $roleStstus = RoleStatus::where('role_id',$role_id)->first();
        $Add = (isset($roleStstus->add))?$roleStstus->add:"";
        $Edit = (isset($roleStstus->edit))?$roleStstus->edit:"";
        $Delete = (isset($roleStstus->delete))?$roleStstus->delete:"";
    	return view('manager.user.alluser',compact('getUser','getskill','getrole','Add','Edit','Delete'));
    }

    public function deleteUser()
    {
    	$userId = request('userId'); 
        $success = User::where('id',$userId)->delete();
        return response(['success'=>true]);
    } 

    public function editUser()
    {
    	$userId = request('userId'); 
        $getuser = User::where('id',$userId)->first();
		$skillID = explode(",",$getuser->skills);
		
        return response(['success'=>true,'uid'=>$getuser->id,'name'=>$getuser->name,'email'=>$getuser->email,'dob'=>$getuser->date_of_birth,'address'=>$getuser->address,'role'=>$getuser->role_id,'phone_no'=>$getuser->phone_no,'skill'=>$skillID,'experience'=>$getuser->experience,'designation'=>$getuser->designation,'image'=>$getuser->image]);
    }

    public function image_uplode(Request $request)
    {
        
        $image_name = '';
        $data = request('image');
        $data = base64_decode($data);
        $image_name = time().'.png';
        $path = public_path() . "/image/" . $image_name;
        file_put_contents($path, $data);
        return response(['success'=>'done','image_name'=> $image_name]);
        
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
