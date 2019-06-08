<?php
	Route::group(['middleware' => ['checkAdmin'], 'prefix' => 'organization'], function(){
		//Route::group([ 'prefix' => 'sportsadmin'], function(){
		
		Route::get('/', function(){
			return view('club.dashboard');
		})->name('clubDashboard');	

		Route::get('/users','PlayerController@clubuser')->name('users.all');	 
		Route::get('/adduser','PlayerController@adduser')->name('users.create');	 
		Route::post('/storeuser','PlayerController@storeuser')->name('users.store');	

		Route::get('/sports/player/{sport_id}','PlayerController@getPlayerBySport');
		Route::get('/sports/coach/{sport_id}','PlayerController@getCoachBySport');

		Route::get('/test', function(){
			$array = array(
							"name" => "Paurush Ankit",
						);
			return view('emails.welcome',$array);
		});

		Route::get('/fees', 'ClubController@fees')->name('club_fees');
		Route::post('/storefees', 'ClubController@storefees')->name('fees.store');
		Route::post('/update_late_fees', 'ClubController@update_late_fees')->name('update_late_fees');

		Route::get('/payment/players/{month}/{year}', 'ClubController@payment_module')->name('payment_module');


		Route::get('/changeuserstatus/{id}', 'UserController@changeuserstatus')->name('changeuserstatus');
		Route::get('/addcoachtoplayer/{sport_id}/{user_id}', 'UserController@addcoachtoplayer')->name('addcoachtoplayer');
		Route::post('/assigncoach', 'UserController@assigncoach')->name('assigncoach');

		Route::get('/recordpayment/{id}', 'RecordPaymentController@recordpayment')->name('recordpayment');

		Route::post('/getinvoices/{id}', 'PaymentController@getinvoices')->name('getinvoices');

		Route::get('/revenue/{month}/{year}','RecordPaymentController@getMonthlyRevenue')->name('revenue_module');
		Route::get('/revenueByCoach/{month}/{year}','RecordPaymentController@revenueByCoach')->name('revenueByCoach');

		Route::post('/release_invoice','RecordPaymentController@release_invoice')->name('release_invoice');

	});

?>