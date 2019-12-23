<?php

namespace App\Http\Controllers\superAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Role;
use App\User;
use Hash;

class AddUserController extends Controller
{

	// get roles from database
   public function addUser(){
    	$roles = Role::get();
    	return view('super-admin.user.add_user',compact('roles'));
   }
   public function addNewUser(Request $request){

      // echo"<pre>"; print_r($_POST); //exit;   
      $validator = Validator::make($request->all(),[
         'name' => 'required',
         'email' => 'required|email',
         'pass' => 'required|min:5|max:15',
         'dob' => 'required|date',
         'address' => 'required',
         'number' => 'required|min:10|numeric',
         'skills' => 'required',
         'experience' => 'required',
         'designation' => 'required',
         // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
         ]);

      if(!$validator->fails()) {
         // echo "shfx"; exit;
         $userID = request('prev_user_id');
         if(isset($userID) && $userID !='' ){
         // echo"<pre>"; print_r($_POST); exit;   
            $id = $_POST['prev_user_id'];
            $role = $_POST['role_name'];
            $name = $_POST['name'];
            $pass = $_POST['pass'];
            $email = $_POST['email'];
            $number = $_POST['number'];
            $address = $_POST['address'];
            $date = $_POST['dob'];
            $skills = $_POST['skills'];
            $experience = $_POST['experience'];
            $designation = $_POST['designation'];
            $old_image = $_POST['old_image'];
   

            $image =  $request->file('e_image');
            if(isset($image) && $image != ""){
                 $destinationPath = public_path('/images');      
                 $new_name = rand() . '.' . $image->getClientOriginalExtension();
                 $image->move($destinationPath, $new_name);  
            }
            else{
                 $new_name= $_POST['old_image'];                 
            }

            $update = User::where('id',$id)->update(['role_id'=>$role,'name'=>$name,'email'=>$email,'password'=>$pass,'phone_no'=>$number,'address'=>$address,'date_of_birth'=> $date, 'skills'=> $skills,'experience'=> $experience,'designation'=> $designation,'image'=>$new_name]);
            return redirect('all_users');
            }
         else
         {
            // echo "<pre>"; print_r($_POST); exit;
            $image =  $request->file('image'); 
            $destinationPath = public_path('/images');      
            $new_name = rand().'.'.$image->getClientOriginalExtension(); 
            $image->move($destinationPath, $new_name); 

            $user = new User();

            $user->role_id = $_POST['role_name'];
            $user->name = $_POST['name'];
            $user->email = $_POST['email'];
            $password = $_POST['pass'];
            $hashed = Hash::make($password);
            $user->password = $hashed;
            $user->phone_no = $_POST['number'];
            $user->address = $_POST['address'];
            // $user->date_of_birth = $_POST['u_dob'];
            $user->skills = $_POST['skills'];
            $user->experience = $_POST['experience'];
            $user->designation = $_POST['designation'];
            $user->image = $new_name;
            $user->save();
            return redirect('add_user');
         }
      }
      else{
         // echo "aeusrhjrjf"; exit;
         return Redirect::back()->withErrors($validator)->withInput($request->input());
      }
   }

   public function GetAllUsers(){
    	$users = User::get();
        $roles = Role::get();
    	// echo "<pre>"; print_r($users); exit;
    	return view('super-admin.user.all_users',compact('users','roles'));
    }
}
