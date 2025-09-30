<?php

namespace app\Model;

use app\Core\BaseModel\BaseModel;

 // Наследование от основного класса -> BaseModel
class User extends BaseModel
{
    protected string $table = 'users';
    protected string $primaryKey = 'id';
}