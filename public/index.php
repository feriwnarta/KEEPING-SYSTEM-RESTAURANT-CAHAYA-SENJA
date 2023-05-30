<?php
date_default_timezone_set('asia/jakarta');
use NextG\Autoreply\App\Router;
use NextG\Autoreply\Controllers\AutoReplyController;

require __DIR__ . '/../vendor/autoload.php';

Router::add('POST', '/reply', AutoReplyController::class, 'request');

Router::run();


