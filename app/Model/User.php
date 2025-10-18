<?php

namespace app\Model;

use app\Core\BaseModel\BaseModel;

 // Наследование от основного класса -> BaseModel
class User extends BaseModel
{
    public const string TABLE = 'users';
    public const string PRIMARY_KEY = 'id';
}