<?php

$route[] = ['/login', '\App\Users\Controllers\UserController@login'];
$route[] = ['/login/auth', '\App\Users\Controllers\UserController@auth'];
$route[] = ['/logout', '\App\Users\Controllers\UserController@logout'];

$route[] = ['/users', '\App\Users\Controllers\UserController@listUsers', 'auth','list-users'];
$route[] = ['/user/create', '\App\Users\Controllers\UserController@create', 'auth','create-users'];
$route[] = ['/user/store', '\App\Users\Controllers\UserController@store', 'auth','create-users'];
$route[] = ['/user/{id}/edit', '\App\Users\Controllers\UserController@edit', 'auth','create-users'];
$route[] = ['/user/{id}/update', '\App\Users\Controllers\UserController@update', 'auth','create-users'];

$route[] = ['/', '\App\Home\Controllers\HomeController@index'];

$route[] = ['/home', '\App\Home\Controllers\HomeController@home', 'auth'];

return $route;
