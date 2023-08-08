<?php
date_default_timezone_set('asia/jakarta');

use NextG\Autoreply\App\Router;
use NextG\Autoreply\Controllers\CustomerController;
use NextG\Autoreply\Controllers\KeepingController;
use NextG\Autoreply\Controllers\MenuController;
use NextG\Autoreply\Controllers\WablastController;
use NextG\Autoreply\Controllers\WhatsappBlastController;

require __DIR__ . '/../vendor/autoload.php';

// keeping controller
Router::add('POST', '/reply', AutoReplyController::class, 'request');
Router::add('GET', '/input-keeping', KeepingController::class, 'index');
Router::add('POST', '/check-phone-number', KeepingController::class, 'checkPhoneNumber');
Router::add('POST', '/get-all-menu', KeepingController::class, 'getMenu');
Router::add('POST', '/save-keeping', KeepingController::class, 'saveKeeping');
Router::add('GET', '/', KeepingController::class, 'showKeeping');
Router::add('GET', '/update-keeping/([0-9a-zA-Z-]*)', KeepingController::class, 'updateKeeping');
Router::add('POST', '/update-keeping/process-update', KeepingController::class, 'processUpdate');
Router::add('POST', '/out-keeping', KeepingController::class, 'outKeeping');
Router::add('POST', '/process-out', KeepingController::class, 'processOut');
Router::add('POST', '/search-menu', KeepingController::class, 'searchMenu');
Router::add('GET', '/test', KeepingController::class, 'makeSpreadSheet');
Router::add('GET', '/sheet', MenuController::class, 'spreadsheet');

// menu controller
Router::add('GET', '/input-menu', MenuController::class, 'inputMenu');
Router::add('POST', '/save-menu', MenuController::class, 'saveMenu');
Router::add('POST', '/update-menu', MenuController::class, 'updateMenu');
Router::add('POST', '/delete-menu', MenuController::class, 'deleteMenu');
Router::add('GET', '/show-menu', MenuController::class, 'menu');

// customer conrtoller
Router::add('GET', '/customer', CustomerController::class, 'showCustomer');
Router::add('POST', '/send-single-message', CustomerController::class, 'sendSingleMessage');
Router::add('POST', '/send-all-message', CustomerController::class, 'sendAllMessage');

// wablast
Router::add('GET', '/wablast', WablastController::class, 'config');
Router::add('POST', '/save-setting-wablast', WablastController::class, 'saveSettingWablast');
Router::add('GET', '/setting-wablast', WablastController::class, 'settingWablast');
Router::add('GET', '/barcode', WablastController::class, 'barcode');

// whatsapp blast controller // test
Router::add('GET', '/woy', WhatsappBlastController::class, 'test');
Router::add('GET', '/new', KeepingController::class, 'messageFormat');

Router::run();
