<?php

/*
 * Базовый класс БД
 */

    namespace app\Core\Database;
    use config\DatabaseConfig;
    use PDO;
    use PDOException;


    class Database
{

    private static PDO $connection;

    public static function getConnection(): PDO
    {
        try {
            $pdo = new PDO(
                "pgsql:host=" . DatabaseConfig::$host . ";port=" . DatabaseConfig::$port . ";dbname=" . DatabaseConfig::$dbname,
                DatabaseConfig::$username,
                DatabaseConfig::$password
            );

            self::$connection = $pdo;
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return self::$connection;
    }
}

/*
 * Статический метод. Так как одна БД, поэтому решил использовать статический метод.
 * Но нужно будет пересмотреть, уместна ли здесь статика...
 *
 */