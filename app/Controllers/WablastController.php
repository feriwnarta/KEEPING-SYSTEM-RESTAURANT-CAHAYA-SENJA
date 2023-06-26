<?php

namespace NextG\Autoreply\Controllers;

use NextG\Autoreply\App\Database;
use NextG\Autoreply\App\View;
use PDOException;

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
        $options = $this->getOption();

        $data = [
            'save' => $messageSaveKeeping,
            'out' => $messageOutKeeping,
            'options' => $options
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

    private function getOption()
    {
        $query = 'SELECT option_name, value_name FROM tb_config WHERE option_name NOT IN ("message_success_save_keeping", "message_success_out_keeping")';

        $this->db->query($query);
        return $this->db->fetchAll();
    }

    public function saveSettingWablast()
    {
        $json = file_get_contents('php://input');
        $obj = json_decode($json, true);


        if (isset($obj['settingIn']) && isset($obj['settingOut'])) {

            try {

                $this->db->conn->beginTransaction();

                $query = 'UPDATE tb_config
                SET value_name = CASE
                    WHEN option_name = "message_success_save_keeping" THEN :inKeeping
                    WHEN option_name = "message_success_out_keeping" THEN :outKeeping
                    ELSE value_name
                  END
                WHERE option_name IN ("message_success_save_keeping", "message_success_out_keeping");';

                $this->db->query($query);
                $this->db->bindData(':inKeeping', $obj['settingIn']);
                $this->db->bindData(':outKeeping', $obj['settingOut']);
                $this->db->execute();

                $this->db->conn->commit();


                echo json_encode('success');
                http_response_code(200);
            } catch (PDOException $e) {

                if ($this->db->conn->inTransaction()) {
                    $this->db->conn->rollBack();
                }

                http_response_code(400);
                echo json_encode('failed');
            }
        }
    }
}
