<?php

namespace NextG\Autoreply\App;

class View
{

    public static function render($view, $yield_view = '', $data = array())
    {

        require_once __DIR__ . "/../Views/{$view}.php";
    }
}
