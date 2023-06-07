<?php

namespace NextG\Autoreply\Controllers;

use NextG\Autoreply\App\View;

class KeepingController
{

    public function index()
    {
        View::render('main', 'keeping/input-keeping');
    }
}
