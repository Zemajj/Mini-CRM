<?php

declare(strict_types=1);

namespace app\Controllers;

use app\Core\BaseController\BaseController;

class HomeController extends BaseController
{
    public function home(): void
    {
        echo "Добро пожаловать на главную страницу!";
    }
}
