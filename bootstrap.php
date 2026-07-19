<?php

use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

/*
 *  В данном файле будет размещено подключение
 * файла .env и autoload
 *
 */
