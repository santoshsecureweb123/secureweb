<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

/* Super Admin Route */
Route::group(['namespace' => 'superAdmin','middleware' => ['isSuperAdmin']], function () {	

	Route::post('imagete','SuperAdminController@imagetest')->name('imagete');

	Route::get('crop',function(){
	return view('crop');
});


	Route::get('superAdmin','SuperAdminController@getDashboard')->name('superAdmin');
	Route::get('add_role', 'AddRoleController@add_role')->name('add_role');
	Route::post('/add_new_role','AddRoleController@addNewRole')->name('add_new_role');
	Route::get('/add_user', 'AddUserController@addUser')->name('add_user');
	Route::post('/add_new_user','AddUserController@addNewUser')->name('add_new_user');
	Route::post('/deleteUser','SuperAdminController@deleteUser')->name('add_new_user');
	Route::get('/all_users', 'AddUserController@GetAllUsers')->name('all_users');
	Route::get('/get_editUser_id', 'SuperAdminController@getEditIdRecord')->name('get_editUser_id');

	Route::get('role_status', 'AddRoleController@roleManagementView')->name('role_status');
		Route::post('role_status', 'AddRoleController@roleManagement')->name('role_status');
		
	Route::get('create_team','TeamController@createTeamView')->name('create_team');
	Route::post('create_team','TeamController@createTeam')->name('create_team');
	Route::get('allteam','TeamController@allteam')->name('allteam');
	Route::get('editTeam','TeamController@editTeam')->name('editTeam');
	Route::get('deleteTeam','TeamController@deleteTeam')->name('deleteTeam');
	Route::get('addQuiz','QuizController@addQuizView')->name('addQuiz');
	Route::post('addQuiz','QuizController@addQuiz')->name('addQuiz');
	Route::get('allQuiz','QuizController@allQuiz')->name('allQuiz');
	Route::get('editQuiz','QuizController@editQuiz')->name('editQuiz');
	Route::get('deleteQuiz','QuizController@deleteQuiz')->name('deleteQuiz');
	Route::get('addQuestion','QuizQuestionController@addQuestionView')->name('addQuestion');
	Route::post('addQuestion','QuizQuestionController@addQuestion')->name('addQuestion');
	Route::get('allQuestion','QuizQuestionController@allQuestion')->name('allQuestion');
	Route::get('editQuestion','QuizQuestionController@editQuestion')->name('editQuestion');
	Route::get('deleteQuestion','QuizQuestionController@deleteQuestion')->name('deleteQuestion');
	});

/* End Super Admin Route */

/* Manager Route */

/*Route::get('/', function () {
    return view('manager.manager.dashboard');
});*/

Route::group(['namespace' => 'manager','middleware' => ['isManager']], function () {
	Route::get('/logout','UserController@logout')->name('logout');
	Route::get('dashboard', 'DashboardController@dashboard');
	Route::get('allskill','SkillController@addSkillView')->name('allskill');
	Route::post('allskill','SkillController@addNewskill')->name('allskill');
	Route::post('getskill','SkillController@getSkill')->name('getskill');
	Route::post('deleteskill','SkillController@deleteSkill')->name('deleteskill');
	Route::post('skillStatus','SkillController@skillStatus')->name('skillStatus');
	Route::get('addnew','UserController@showUserForm')->name('addnew');
	Route::post('addnew','UserController@addNewUser')->name('addnew');
	Route::post('crop_image','UserController@image_uplode')->name('crop_image');
	Route::get('allUser','UserController@getAllUser')->name('allUser');
	Route::get('deleteUser','UserController@deleteUser')->name('deleteUser');
	Route::get('editUser','UserController@editUser')->name('editUser');
	Route::get('addbroadcast','BroadcastController@broadcastView')->name('addbroadcast');
	Route::post('addbroadcast','BroadcastController@broadcastSave')->name('addbroadcast');

});



Route::group(['namespace' => 'user','middleware' => ['isUser']], function () {
	Route::get('userdashboard','UserController@dashboard')->name('userdashboard');
	Route::get('allQuiz','QuizController@allQuiz')->name('allQuiz');
	Route::get('startQuiz','QuizController@QuizStart')->name('startQuiz');
	Route::post('quizAnswer','QuizController@quizAnswer')->name('quizAnswer');

});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('news','NewsController@newsfunc');


//Route::get('news','NewsController@viewNews');


