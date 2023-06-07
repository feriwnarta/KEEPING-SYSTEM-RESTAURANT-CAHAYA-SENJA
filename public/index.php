<?php
date_default_timezone_set('asia/jakarta');
use NextG\Autoreply\App\Router;
use NextG\Autoreply\Controllers\MainController;
use NextG\Autoreply\Controllers\KeepingController;


require __DIR__ . '/../vendor/autoload.php';

Router::add('POST', '/reply', AutoReplyController::class, 'request');
Router::add('GET', '/', MainController::class, 'index');
Router::add('GET', '/input-keeping', KeepingController::class, 'index');

Router::run();


