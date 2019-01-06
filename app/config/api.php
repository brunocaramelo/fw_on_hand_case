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
    '/api/v1/contacts/list',
    '\App\Integration\Contacts\Controllers\ContactsController@listContacts',
    'auth',
    'show-message-result'
];

return $route;
