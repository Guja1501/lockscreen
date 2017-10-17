<?php

use Illuminate\Support\Facades\Route;

$name = config('lockscreen.name','lockscreen');
$url = config('lockscreen.redirect_if_locked', '/lockscreen');

Route::middleware('locked')->get($url, '\Rangoo\Lockscreen\Controller\LockscreenController@showUnlockForm')->name($name);
Route::middleware('unlock')->post($url, '\Rangoo\Lockscreen\Controller\LockscreenController@lock');
Route::middleware('locked')->delete($url, '\Rangoo\Lockscreen\Controller\LockscreenController@unlock');
