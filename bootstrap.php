<?php

declare(strict_types=1);

use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dotenv
    ->required(['DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD'])
    ->notEmpty();
$dotenv->required(['DB_PORT'])->notEmpty()->isInteger();

$dbPort = $_ENV['DB_PORT'];
$dbPort = (int) $dbPort;

if ($dbPort < 1 || $dbPort > 65535) {
    die("DB Port must be between 1 and 65535");
}
