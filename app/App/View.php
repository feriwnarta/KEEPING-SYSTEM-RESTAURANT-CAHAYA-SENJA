<?php

namespace NextG\Autoreply\App;

class View
{

    public static function render($view, $data = array())
    {

        require_once __DIR__ . "/../Views/{$view}.php";
    }
}
