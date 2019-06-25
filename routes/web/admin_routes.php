<?php
	Route::group(['middleware' => ['checkSuperUser'], 'prefix' => 'sportsadmin'], function(){
		//Route::group([ 'prefix' => 'sportsadmin'], function(){
		
		Route::get('', function(){
			return view('admin.dashboard');
		})->name('adminDashboard');

		
		Route::get('sendmail','ClubController@sendmail');
		

		Route::resource('/clubs','ClubController');
		Route::get('/clubDetail/{id}','ClubController@clubDetail')->name('clubDetail');
		Route::get('/loginAsUser/{id}','ClubController@loginAsUser')->name('loginAsUser');

		Route::get('/clubDetails/{id}','ClubController@clubDetails')->name('clubDetails');
		Route::get('/loginAsUser/{id}','ClubController@loginAsUser')->name('loginAsUser');

		 
	});

?>