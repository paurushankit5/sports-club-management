<?php
	Route::group(['middleware' => ['checkSuperUser'], 'prefix' => 'sportsadmin'], function(){
		//Route::group([ 'prefix' => 'sportsadmin'], function(){
		
		Route::get('', function(){
			return view('admin.dashboard');
		})->name('adminDashboard');

		
		Route::get('sendmail','ClubController@sendmail');
		

		Route::resource('/clubs','ClubController');

		 
	});

?>