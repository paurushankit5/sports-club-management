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

// Route::get('/', function () {
//     return view('welcome');
// })->name('index');

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
})->name('logout');

Route::get('/', 'HomeController@index')->name('index');


Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dash', 'HomeController@dashboard')->name('dash');
Route::get('/about-us', 'HomeController@aboutUs')->name('about');
Route::get('/contact-us', 'HomeController@contactUs')->name('contact');
// Route::get('/login', 'HomeController@index')->name('login');

Route::get('/home','HomeController@dashboard')->name('home');


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

		 
	Route::get('/showreceivedpayment/{id}','RecordPaymentController@showreceivedpayment')->name('showreceivedpayment');
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
	Route::post('/storeUnAssociatedSportsToClub/{id}','SportController@storeUnAssociatedSportsToClub')->name('storeUnAssociatedSportsToClub');

	Route::get('/getClubUnassociatedSports/{id}', 'SportController@getClubUnassociatedSports')->name('getClubUnassociatedSports');

	Route::post('/removeSportClubAssociation/{id}', 'SportController@removeSportClubAssociation')->name('removeSportClubAssociation');
	Route::get('/revenueByCoach/{month}/{year}/{club_id}','RecordPaymentController@revenueByCoach')->name('revenueByCoach');

	Route::get('/CoachRevenue/{user_id}/{month}/{year}', 'RecordPaymentController@getOneCoachRevenue')->name('getOneCoachRevenue');

	Route::get('/player/invoices/{id}', 'PaymentController@playerInvoices')->name('playerInvoices');
	Route::get('/player/receivedPayments/{id}', 'RecordPaymentController@receivedPayments')->name('player.receivedPayments');

	Route::get('/editclub/{club_id}', 'ClubController@editclub' )->name('editclub');
	Route::post('club/update/{club_id}', 'ClubController@updateclub')->name('updateclub');

	Route::get('/idcard/{id}','UserController@generateidcard')->name('generateidcard');

	Route::get('/clubDetail/{id}','ClubController@clubDetail')->name('clubDetail');

	Route::get('club/revenue/sports/{month}/{year}/{club_id}', 'RecordPaymentController@revenueBySport')->name('revenueBySport');

	Route::post('club/uploadLogo/{club_id}', 'ClubController@uploadLogo')->name('uploadLogo');

});

Route::get('/mail1','PaymentController@mail');

