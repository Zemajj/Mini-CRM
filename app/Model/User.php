<?php

namespace app\Model;

use app\Core\BaseModel\BaseModel;

class User extends BaseModel
{
    protected string $table = 'users';

}

$userModel = new User();
$users = $userModel->all();
print_r($users);
