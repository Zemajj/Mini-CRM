<?php

namespace app\Controllers;

use app\Core\BaseController\BaseController;

class HomeController extends BaseController
{


    public function home() {
        echo "Добро пожаловать на главную страницу!";
    }
    /*
     * Данный контроллер будет отрисовывать
     * домашнюю страницу, где будет не большое вступление.
     * А возможно и не большое описание, что за сайт и т.д.
     */
}