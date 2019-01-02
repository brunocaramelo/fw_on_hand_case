<?php


$dsn = 'mysql:host='.getenv('DB_HOST').';dbname='.getenv('DB_DATABASE');
try {
    $db = new PDO($dsn, getenv('DB_ROOT_USERNAME'), getenv('DB_ROOT_PASSWORD'));
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