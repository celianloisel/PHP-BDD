<?php

require_once __DIR__ . "/config.php";

try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'] . ';port=' . $config['db']['port'];
    $db = new PDO($dsn, $config['db']['user'], $config['db']['pass']);
} catch (PDOException $e) {
    die('Erreur MySQL. ' . $e->getMessage());
}