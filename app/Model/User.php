<?php

namespace app\Model;

use app\Core\BaseModel\BaseModel;

 // Наследование от основного класса -> BaseModel
class User extends BaseModel
{
     const string table = 'users';
     const string primaryKey = 'id';
}