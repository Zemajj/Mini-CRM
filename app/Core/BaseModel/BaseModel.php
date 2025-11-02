<?php

declare(strict_types=1); // строгая типизация (только для этого файла!)

namespace app\Core\BaseModel;


use app\Core\Database\Database;
use PDO;


class BaseModel

// объявление свойств
{
    protected PDO $pdo;

    // передаем подключение к БД
    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    /*
     * Простой метод для проверки:
     * таблица работает,
     * подключение есть,
     * данные читаются
     * и т.д.
     */
    public function all(): ?array
    {
        if (!defined(static::class . '::TABLE')) {
            throw new \RuntimeException('TABLE constant not defined in ' . static::class);
        }
        try {
            $sql = 'SELECT * FROM ' . static::TABLE;
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (\PDOException $e) {
            error_log($e->getMessage());
        }
        return  $result ?: null;
    }

    // Метод для поиска по ключу
    public function find(int $id): ?array
    {
        // Сразу в бд не входим, делаем проверку

        /*
         *Пока оставлю проверку id, потом придумаю, как правильно избавиться от него
         */

        if ($id <= 0) {
            throw new \InvalidArgumentException('ID must be a positive integer');
        }
        // подключение к БД
        try {
            $sql =  'SELECT * FROM ' . static::TABLE . ' WHERE ' . static::PRIMARY_KEY . ' = :id LIMIT 1';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
           error_log($e->getMessage());
        }
        return $row !== false ? $row : null;
    }
}