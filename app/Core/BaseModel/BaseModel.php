<?php

namespace app\Core\BaseModel;

use app\Core\Database\Database;
use PDO;


class BaseModel
{   protected PDO $pdo;
    protected string $table = '';
    public function __construct( protected string $primaryKey = 'id')
    {
        $this->pdo = Database::getConnection();
    }

    public function all(): array {
        $query = ("SELECT * FROM {$this->table}");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($query);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
}