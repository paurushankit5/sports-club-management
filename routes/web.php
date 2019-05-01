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

Route::get('/', function () {
    return view('welcome');
});

foreach(glob(dirname(__FILE__) . '/web/*.php') AS $file){
	require_once($file);
}

Auth::routes();

Route::get('logout', function(){
	Auth::logout();
	return redirect('/');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function(){
		
	Route::get('myprofile', 'UserController@myprofile')->name('myprofile');
	Route::get('user/profile/{id}', 'UserController@getoneuserprofile')->name('getoneuserprofile');
	Route::get('editprofile', 'UserController@editprofile')->name('editprofile');

	Route::post('updateProfilePic', 'UserController@updateProfilePic')->name('updateProfilePic');
	Route::post('storeidproof', 'UserController@storeidproof')->name('storeidproof');
	Route::post('updateprofile', 'UserController@updateprofile')->name('updateprofile');	

		 
});

