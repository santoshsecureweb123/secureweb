<?php

namespace App\Http\Controllers\superAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Charts;
class SuperAdminController extends Controller
{
   function getEditIdRecord(Request $request){
   	
   	$id = request('id');
   	$user = User::where('id',$id)->get();
   	return response(['user'=>$user]);
   }
   function deleteUser(Request $request){
        $id = request('id');
        // echo $id; exit;
        $user = User::find($id);
        $user->delete();
        return redirect('all_users');
    }
    function getDashboard(){
    $users = User::pluck('role_id')->toArray();
    $users = array_count_values($users);
    $Admin = (isset($users[1]))?$users[1]:'0';
    $Manager = (isset($users[2]))?$users[2]:'0';
    $User = (isset($users[3]))?$users[3]:'0';
    $TL = (isset($users[4]))?$users[4]:'0';
    $chart = Charts::create('pie', 'highcharts')
        ->title('All User')
        ->labels(['Admin', 'Manager', 'User','Team Leader'])
        ->values([$Admin,$Manager,$User,$TL]);
       return view('super-admin.super-admin.dashboard',compact('chart'));
   }

  public function imagetest(Request $request)
  {
    echo "<pre>";
    print_r($_POST); 
     if($request->hasFile('profile_image')) {
        //get filename with extension
        print_r($request->file('profile_image')); exit;
        $filenamewithextension = $request->file('profile_image')->getClientOriginalName();
 
        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
 
        //get file extension
        $extension = $request->file('profile_image')->getClientOriginalExtension();
 
        //filename to store
        $filenametostore = $filename.'_'.time().'.'.$extension;
 
        //Upload File
        $request->file('profile_image')->storeAs('public/profile_images', $filenametostore);
 
        if(!file_exists(public_path('storage/profile_images/crop'))) {
            mkdir(public_path('storage/profile_images/crop'), 0755);
        }
 
        // crop image
        $img = Image::make(public_path('storage/profile_images/'.$filenametostore));
        $croppath = public_path('storage/profile_images/crop/'.$filenametostore);
 
        $img->crop($request->input('w'), $request->input('h'), $request->input('x1'), $request->input('y1'));
        $img->save($croppath);
 
        // you can save crop image path below in database
        $path = asset('storage/profile_images/crop/'.$filenametostore);
 
        return redirect('image')->with(['success' => "Image cropped successfully.", 'path' => $path]);
    }
  }
}
