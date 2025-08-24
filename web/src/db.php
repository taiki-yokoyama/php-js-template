<?php
declare(strict_types=1);

function db(): PDO {
    $host = getenv('DB_HOST') ?: 'db';
    $dbname = getenv('DB_NAME') ?: 'appdb';
    $user = getenv('DB_USER') ?: 'appuser';
    $pass = getenv('DB_PASS') ?: 'password';
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
    return $pdo;
}
