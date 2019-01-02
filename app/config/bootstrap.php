<?php

use Illuminate\Container\Container;

if (!session_id()) {
    session_start();
}


require __DIR__.'/../vendor/AutoloaderClass.php';

$autoload = new AutoloaderClass();
$autoload->load();

$applicationApi = new \Core\ApplicationApi([]);
$applicationApi->run();

$application = new \Core\ApplicationWeb([]);
$application->run();
