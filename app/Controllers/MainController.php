<?php

namespace NextG\Autoreply\Controllers;

use NextG\Autoreply\App\View;

class MainController
{

    public function index()
    {
        View::render('main');
    }
}
