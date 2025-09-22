<?php

namespace app\Core\BaseController;

class BaseController
{
    protected function render($view, $data = []): void
    {
        extract($data);

        include __DIR__ . "/../View/$view.php";
    }
}