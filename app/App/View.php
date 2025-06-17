<?php

namespace Moonphp\Moonphp\App;

class View
{
    public static function render($view, $data = array())
    {
        $viewPath = __DIR__ . '/../Views/' . $view . '.php';

        if (file_exists($viewPath)) {
            extract($data);
            ob_start();
            include $viewPath;
            return ob_get_clean();
        } else {
            throw new \Exception("View  '$view' tidak ditemukan.", 404);
        }
    }
}