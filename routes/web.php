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
})->name('index');

foreach(glob(dirname(__FILE__) . '/web/*.php') AS $file){
	require_once($file);
}

Auth::routes();

Route::get('logout', function(){
	if(\Session::has('admin_id')){
		\Session::forget('admin_id');
	}
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
	Route::post('storePlayerMembership', 'UserController@storePlayerMembership')->name('storePlayerMembership');

	Route::post('addCoachFees', 'UserController@addCoachFees')->name('addCoachFees');

	Route::get('user/payment/{user_id}/{month}/{year}','PaymentController@payment')->name('payment');	
	Route::get('user/showpayment/{user_id}/{month}/{year}','PaymentController@showpayment')->name('showpayment');	
	Route::post('user/payment/{user_id}/{month}/{year}','PaymentController@storepayment')->name('storepayment');	

		 
	Route::get('/showreceivedpayment/{id}','RecordPaymentcontroller@showreceivedpayment')->name('showreceivedpayment');
	Route::post('/getpaymentdetails','RecordPaymentController@getpaymentdetails')->name('getpaymentdetails');

	Route::post('/storerecordpayment/{user_id}', 'RecordPaymentController@storerecordpayment')->name('storerecordpayment');


	Route::get('/demo', 'UserController@demo'); 

	Route::get('downloadInvoice/{user_id}/{month}/{year}','PaymentController@downloadInvoice')->name('downloadInvoice');

	Route::get('/email', 'EmailController@sendEmail');

	Route::post('/storeuser','PlayerController@storeuser')->name('users.store');	

	Route::get('/loginAsSuperadmin', 'ClubController@loginAsSuperadmin')->name('loginAsSuperadmin');

	Route::post('/removeSportUserAssociation/{user_id}', 'SportController@removeSportUserAssociation')->name('removeSportUserAssociation');
	Route::get('/getUnAssociatedSports/{user_id}', 'SportController@getUnAssociatedSports')->name('getUnAssociatedSports');
	Route::post('/storeUnAssociatedSports/{user_id}', 'SportController@storeUnAssociatedSports')->name('storeUnAssociatedSports');

	Route::get('/user/edit/profile/{id}', 'UserController@editOneProfile')->name('editOneProfile');
	Route::post('/user/edit/profile/{id}', 'UserController@updateoneuserprofile')->name('updateoneuserprofile');

	Route::post('/storeuseridproof/{id}','UserController@storeuseridproof')->name('storeuseridproof');

});

Route::get('/mail1','PaymentController@mail');