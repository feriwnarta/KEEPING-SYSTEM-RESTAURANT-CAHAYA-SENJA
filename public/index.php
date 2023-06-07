<?php
date_default_timezone_set('asia/jakarta');
use NextG\Autoreply\App\Router;
use NextG\Autoreply\Controllers\MainController;

require __DIR__ . '/../vendor/autoload.php';

Router::add('POST', '/reply', AutoReplyController::class, 'request');
Router::add('GET', '/', MainController::class, 'home');

Router::run();


