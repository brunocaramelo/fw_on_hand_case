<?php

// $route[] = ['/api/v1/create-contact', '\App\Users\Controllers\UserController@login'];
// $route[] = ['/api/v1/create-list', '\App\Users\Controllers\UserController@login'];
// $route[] = ['/api/v1/create-message', '\App\Users\Controllers\UserController@login'];
// $route[] = ['/api/v1/send-message', '\App\Users\Controllers\UserController@login'];
$route[] = ['/api/v1/show-results', '\App\Integration\Results\Controllers\ResultsController@showResults','auth','show-message-result'];

return $route;
