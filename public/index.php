<?php
date_default_timezone_set('asia/jakarta');

use NextG\Autoreply\App\Router;
use NextG\Autoreply\Controllers\MainController;
use NextG\Autoreply\Controllers\KeepingController;



require __DIR__ . '/../vendor/autoload.php';

Router::add('POST', '/reply', AutoReplyController::class, 'request');
Router::add('GET', '/input-keeping', KeepingController::class, 'index');
Router::add('POST', '/get-all-menu', KeepingController::class, 'getMenu');
Router::add('POST', '/save-keeping', KeepingController::class, 'saveKeeping');
Router::add('GET', '/', KeepingController::class, 'showKeeping');
Router::add('GET', '/update-keeping/([0-9a-zA-Z-]*)', KeepingController::class, 'updateKeeping');
Router::add('POST', '/update-keeping/process-update', KeepingController::class, 'processUpdate');
Router::add('POST', '/out-keeping', KeepingController::class, 'outKeeping');
Router::add('POST', '/process-out', KeepingController::class, 'processOut');

Router::run();
