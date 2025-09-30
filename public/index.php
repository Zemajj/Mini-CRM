<?php

require_once __DIR__ . '/../vendor/autoload.php';


use app\Core\Database\Database;
use app\Model\User;

    $userModel = new User();
    print_r($userModel->all());
