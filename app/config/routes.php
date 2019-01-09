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
$route[] = ['/lists', '\App\Lists\Controllers\ListController@index','auth','create-contact-list'];
$route[] = ['/list/new', '\App\Lists\Controllers\ListController@newList','auth','create-contact-list'];

$route[] = ['/list/{id}/contacts', '\App\Contacts\Controllers\ContactsController@getContactsFromListId','auth','create-contact-list'];
$route[] = ['/list/{id}/contact/new', '\App\Contacts\Controllers\ContactsController@createContactsFromListId','auth','create-contact-list'];

$route[] = ['/messages', '\App\Messages\Controllers\MessageController@index','auth','create-message'];
$route[] = ['/message/new', '\App\Messages\Controllers\MessageController@newMessage','auth','create-message'];
$route[] = ['/message/{code}/send', '\App\Messages\Controllers\MessageController@sendMessage','auth','create-message'];
$route[] = ['/message/{code}/show-results', '\App\Messages\Controllers\MessageController@showResults','auth','create-message'];

$route[] = ['/home', '\App\Home\Controllers\HomeController@home', 'auth'];

return $route;
