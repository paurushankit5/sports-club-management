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

		Route::get('/test', function(){
			$array = array(
							"name" => "Paurush Ankit",
						);
			return view('emails.welcome',$array);
		});
	});
?>