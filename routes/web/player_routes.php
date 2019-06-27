<?php
	Route::group(['middleware' => ['checkPlayer'], 'prefix' => 'player'], function(){
		
		Route::get('/dashboard','PlayerController@dashboard')->name('playerDashboard');	

		 

	});

?>