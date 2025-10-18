<?php

require_once __DIR__ . '/../vendor/autoload.php';


use app\Core\Database\Database;
use app\Model\User;

    $users = new User()->all();
    var_dump($users);
