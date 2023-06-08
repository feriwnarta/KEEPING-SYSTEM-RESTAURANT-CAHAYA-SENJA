<?php
date_default_timezone_set('asia/jakarta');

use NextG\Autoreply\App\Router;
use NextG\Autoreply\Controllers\MainController;
use NextG\Autoreply\Controllers\KeepingController;



require __DIR__ . '/../vendor/autoload.php';

Router::add('POST', '/reply', AutoReplyController::class, 'request');
Router::add('GET', '/', MainController::class, 'index');
Router::add('GET', '/input-keeping', KeepingController::class, 'index');
Router::add('POST', '/get-all-menu', KeepingController::class, 'getMenu');
Router::add('POST', '/save-keeping', KeepingController::class, 'saveKeeping');
Router::add('GET', '/keeping', KeepingController::class, 'showKeeping');
Router::add('GET', '/update-keeping/([0-9a-zA-Z-]*)', KeepingController::class, 'updateKeeping');

Router::run();
