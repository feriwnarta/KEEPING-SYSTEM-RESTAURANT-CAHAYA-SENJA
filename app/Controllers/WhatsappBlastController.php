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
        $this->waService->reportRealtime();
    }
}
