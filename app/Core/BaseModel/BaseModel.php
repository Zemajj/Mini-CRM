<?php

declare(strict_types=1); // строгая типизация (только для этого файла!)

namespace app\Core\BaseModel;


use app\Core\Database\Database;
use PDO;


class BaseModel

// объявление свойств
{
    protected PDO $pdo;
    protected static string $table = '';
    protected static string $primaryKey = '';

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
        if (static::$table === '') {
            throw new \RuntimeException('Table not set in model');
        }
        try {
            $sql = "SELECT * FROM {static::table}";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
        } catch (\PDOException $e) {
            return $stmt->fetchAll();
        }

        return null;
    }

    // Метод для поиска по ключу
    public function find(int $id): ?array
    {
        // Сразу в бд не входим, делаем проверку


        if ($id <= 0) {
            return null;
        }

        try {
            $sql = "SELECT * FROM {static::table} static::primaryKey = :id LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row !== false ? $row : null;
        } catch (\PDOException $e) {
            return $stmt->fetchAll();
        }
    }
}