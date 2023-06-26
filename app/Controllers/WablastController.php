<?php

namespace NextG\Autoreply\Controllers;

use NextG\Autoreply\App\Database;
use NextG\Autoreply\App\View;

class WablastController
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function config()
    {
        $messageSaveKeeping = $this->getSuccesSaveKeeping();
        $messageOutKeeping = $this->getSuccessOutKeeping();

        $data = [
            'save' => $messageSaveKeeping,
            'out' => $messageOutKeeping
        ];

        View::render('main', 'wablast/wablast', $data);
    }

    private function getSuccesSaveKeeping()
    {
        $query = 'SELECT value_name FROM tb_config WHERE option_name = :val';
        $this->db->query($query);
        $this->db->bindData(':val', 'message_success_save_keeping');
        return $this->db->fetch()['value_name'];
    }

    private function getSuccessOutKeeping()
    {
        $query = 'SELECT value_name FROM tb_config WHERE option_name = :val';
        $this->db->query($query);
        $this->db->bindData(':val', 'message_success_out_keeping');
        return $this->db->fetch()['value_name'];
    }
}
