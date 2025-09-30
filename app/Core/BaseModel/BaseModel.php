<?php

namespace app\Core\BaseModel;

use app\Core\Database\Database;
use PDO;


class BaseModel

// объявление свойств
{   protected PDO $pdo;
    protected string $table = '';
    protected string $primaryKey = '';

    // передаем подключение к БД
    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    // Метод
    public function all(): array {
        if($this->table === '') {
            throw new \RuntimeException('Table not set in model');
        }
        try {
            $sql = "SELECT * FROM {$this->table}";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
        } catch(\PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}