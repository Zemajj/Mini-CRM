<?php

/*
 * Базовый класс БД
 */

    namespace app\Core\Database;
    use config\DatabaseConfig;
    use PDO;
    use PDOException;
    use RuntimeException;


    class Database
{

    private static PDO $connection;

        public static function getConnection(): PDO
        {
            try {
                $pdo = new PDO(
                    "pgsql:host=" . DatabaseConfig::$host
                    . ";port=" . DatabaseConfig::$port
                    . ";dbname=" . DatabaseConfig::$dbname,
                    DatabaseConfig::$username,
                    DatabaseConfig::$password
                );

                // Сначала настраиваем PDO…
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // сохраняем в статическое свойство
                self::$connection = $pdo;

                //сразу возвращаем готовое соединение
                return self::$connection;

            } catch (PDOException $e) {
                // Логируем
                error_log('DB connection error: ' . $e->getMessage());

                throw new RuntimeException('Ошибка подключения к базе данных', 0, $e);
            }
        }
}
/*
 * Статический метод. Так как одна БД, поэтому решил использовать статический метод.
 * Но нужно будет пересмотреть, уместна ли здесь статика...
 *
 */