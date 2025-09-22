<?php

namespace app\Core\BaseModel;
use app\Core\Database\Database;


class BaseModel
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

}