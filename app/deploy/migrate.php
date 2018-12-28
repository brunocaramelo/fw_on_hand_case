<?php


$dsn = 'mysql:host='.getenv('DB_HOST').';dbname='.getenv('DB_DATABASE');
try {
    $db = new PDO($dsn, getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
    $sql = file_get_contents('storage/database/create-database.sql');
    $qr = $db->exec($sql);
} catch (PDOException $e) {
    die($e->getMessage());
}