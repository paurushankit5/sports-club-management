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

		Route::get('/create/User/{id}','UserController@createUser')->name('clubs.createUser');
		
		Route::get('/club/fees/{id}', 'AdminController@getClubFees')->name('admin.fees');

	});

?>
