<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Session Name
	|--------------------------------------------------------------------------
	|
	| This value is the name of lockscreen session. This value is
	| used when the framework needs to put/get lockscreen status.
	|
	*/
	'name' => 'lockscreen',

	/*
	|--------------------------------------------------------------------------
	| Redirect Urls
	|--------------------------------------------------------------------------
	|
	| This value is the urls of lockscreen. This value is used when the
	| middleware or controller needs to redirect by current status
	|
	*/
	'redirect_if_locked' => '/lockscreen',
	'redirect_if_unlocked' => '/',

	/*
	|--------------------------------------------------------------------------
	| Time Before Lock
	|--------------------------------------------------------------------------
	|
	| This value is just for javascript at the moment because this
	| package has not auto lock/unlock, it's based on front end
	|
	| in seconds.
	|
	*/
	'time' => 30,

	/*
	|--------------------------------------------------------------------------
	| View Name
	|--------------------------------------------------------------------------
	|
	| This value is because not adding something in
	| you controller just change this thing and
	|
	*/
	'unlock_form_view' => 'auth.lock',

];