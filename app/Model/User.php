<?php

declare(strict_types=1);

namespace app\Model;

use app\Core\BaseModel\BaseModel;

class User extends BaseModel
{
    public const string TABLE = 'users';
    public const string PRIMARY_KEY = 'id';
}
