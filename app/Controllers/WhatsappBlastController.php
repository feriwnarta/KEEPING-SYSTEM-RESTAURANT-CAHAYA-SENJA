<?php

namespace NextG\Autoreply\Controllers;

use NextG\Autoreply\App\View;
use NextG\Autoreply\Services\WhatsappBlastService;

class WhatsappBlastController
{
    private $waService;

    public function __construct()
    {
        $this->waService = new WhatsappBlastService;
    }

    public function test()
    {
        $payload = [
            "data" => [
                [
                    'phone' => '085714342528',
                    'message' => 'hello there',
                ],
                [
                    'phone' => '085714342528',
                    'message' => 'hello there',
                ]
            ]
        ];
        
        var_dump($this->waService->sendMultipleText($payload));
    }
}
