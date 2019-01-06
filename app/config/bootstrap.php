<?php


if (!session_id()) {
    session_start();
}

date_default_timezone_set('America/Sao_Paulo');

require __DIR__.'/../vendor/AutoloaderClass.php';

$autoload = new AutoloaderClass();
$autoload->load();

$applicationApi = new \Core\ApplicationApi([]);
$applicationApi->run();

if ($applicationApi->isValid()) {
    return;
}

$application = new \Core\ApplicationWeb([]);
$application->run();
