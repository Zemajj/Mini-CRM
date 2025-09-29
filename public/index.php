<?php

require_once __DIR__ . '/../vendor/autoload.php';


use app\Core\Database\Database;

$db = Database::getConnection();

var_dump($db);
