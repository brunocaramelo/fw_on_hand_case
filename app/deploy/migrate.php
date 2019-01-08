<?php

require __DIR__.'/../core/ConfigParser.php';


$conf = (new \Core\ConfigParser())->get('database')['mysql'];
$dsn = 'mysql:host='.$conf['host'].';';
try {
    $db = new PDO($dsn, $conf['root_username'], $conf['root_pass']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(
        PDO::MYSQL_ATTR_INIT_COMMAND,
        "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'"
    );

    $sql = file_get_contents('storage/database/create-database.sql');
    $qr = $db->exec($sql);
} catch (PDOException $e) {
    die($e->getMessage());
}
