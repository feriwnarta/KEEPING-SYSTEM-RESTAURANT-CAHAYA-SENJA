<?php
namespace NextG\Autoreply\Controllers;
use NextG\Autoreply\App\View;

class MainController {

    public function home() {
        View::render('home');
    }

}