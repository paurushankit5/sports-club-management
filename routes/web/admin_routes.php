<?php
	Route::group(['middleware' => ['checkSuperUser'], 'prefix' => 'sportsadmin'], function(){
		//Route::group([ 'prefix' => 'sportsadmin'], function(){
		
		Route::get('', function(){
			return view('admin.dashboard');
		})->name('adminDashboard');

		Route::get('/clubs', function(){
			return view('admin.showclubs');
		})->name('adminClubs');

		Route::get('/addclub', function(){
			return view('admin.createClub');
		})->name('adminAddClub');
		 
	});

?>