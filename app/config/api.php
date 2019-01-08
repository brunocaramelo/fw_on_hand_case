<?php

// $route[] = ['/api/v1/create-contact', '\App\Users\Controllers\UserController@login'];
// $route[] = ['/api/v1/create-list', '\App\Users\Controllers\UserController@login'];
// $route[] = ['/api/v1/create-message', '\App\Users\Controllers\UserController@login'];
// $route[] = ['/api/v1/send-message', '\App\Users\Controllers\UserController@login'];
$route[] = [
    '/api/v1/show-results',
    '\App\Integration\Results\Controllers\ResultsController@showResults',
    'auth',
    'show-message-result'
];
$route[] = [
    '/api/v1/list/{code}/contacts/',
    '\App\Integration\Contacts\Controllers\ContactsController@listContacts',
    'auth',
    'create-contact-list'
];

$route[] = [
    '/api/v1/lists',
    '\App\Integration\Lists\Controllers\ListsController@getAll',
    'auth',
    'create-contact-list'
];
$route[] = [
    '/api/v1/list/create',
    '\App\Integration\Lists\Controllers\ListsController@createList',
    'auth',
    'create-contact-list'
];
$route[] = [
    '/api/v1/contact/create',
    '\App\Integration\Contacts\Controllers\ContactsController@createContact',
    'auth',
    'create-contact-list'
];

return $route;
