<?php
	Route::group(['middleware' => ['checkCoach'], 'prefix' => 'coach'], function(){
		
		Route::get('/','CoachController@dashboard')->name('coachDashboard');	

		Route::get('/myplayers/{sport_id}', 'CoachController@myplayers')->name('myplayers');

		Route::post('/add_session', 'CoachController@add_session')->name('add_session');

	});

?>