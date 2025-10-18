<?php

require_once __DIR__ . '/../vendor/autoload.php';


use app\Core\Database\Database;
use app\Model\User;

    $users = new User()->find(33);
    var_dump($users);
