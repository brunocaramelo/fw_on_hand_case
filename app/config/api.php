<?php

$route[] = [
    '/api/v1/message/{code}/show-results',
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
$route[] = [
    '/api/v1/messages',
    '\App\Integration\Messages\Controllers\MessageController@listMessages',
    'auth',
    'create-contact-list'
];
$route[] = [
    '/api/v1/message/create',
    '\App\Integration\Messages\Controllers\MessageController@createMessage',
    'auth',
    'create-message'
];
$route[] = [
    '/api/v1/message/update',
    '\App\Integration\Messages\Controllers\MessageController@updateMessage',
    'auth',
    'create-message'
];

$route[] = [
    '/api/v1/message/send',
    '\App\Integration\Messages\Controllers\MessageController@sendMessage',
    'auth',
    'invite-message'
];

$route[] = [
    '/api/v1/message/{code}',
    '\App\Integration\Messages\Controllers\MessageController@getMessageByCode',
    'auth',
    'create-message'
];
$route[] = [
    '/api/v1/contact/{code}',
    '\App\Integration\Contacts\Controllers\ContactsController@getContactByCode',
    'auth',
    'create-message'
];
$route[] = [
    '/api/v1/contacts/update',
    '\App\Integration\Contacts\Controllers\ContactsController@updateContact',
    'auth',
    'create-contact-list'
];

return $route;
