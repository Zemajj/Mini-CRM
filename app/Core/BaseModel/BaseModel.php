<?php

namespace app\Core\BaseModel;
use app\Core\Database\Database;
use PDO;



class BaseModel
{
    public function __construct(protected pdo $pdo, protected string $table, protected string $primaryKey = 'id')
    {
        $this->pdo = Database::getConnection();
    }

    public function all(): array {
        $query = ("SELECT * FROM {$this->table}");
        $stmt = $this->pdo->query($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
}