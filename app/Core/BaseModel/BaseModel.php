<?php

declare(strict_types=1);

namespace app\Core\BaseModel;


use app\Core\Database\Database;
use PDO;


class BaseModel

// объявление свойств
{
    protected PDO $pdo;
    protected string $table = '';
    protected string $primaryKey = '';

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
    public function all(): array
    {
        if ($this->table === '') {
            throw new \RuntimeException('Table not set in model');
        }
        try {
            $sql = "SELECT * FROM {$this->table}";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Метод для поиска по ключу
    public function find(int $id): ?array
    {
        // Сразу в бд не входим, делаем проверку и выкидывает null

        if ($this->table === '') {
            throw new \RuntimeException('Table not set in model');
        }
        if ($id <= 0) {
            return null;
        }

        try {
            $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row !== false ? $row : null;
        } catch (\PDOException $e) {
            return null;
        }
    }
}