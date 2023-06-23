<?php

namespace NextG\Autoreply\Controllers;

use NextG\Autoreply\App\Database;
use NextG\Autoreply\App\View;
use NextG\Autoreply\Services\WhatsappBlastService;

class CustomerController
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function showCustomer()
    {
        $rs = [];
        $query = 'SELECT phone_number, cust_name, id_cust FROM tb_customer';

        $this->db->query($query);
        $rs = $this->db->fetchAll();

        if (empty($rs)) $rs = [];

        View::render('main', 'customer/show-customer', $rs);
    }

    public function sendSingleMessage()
    {
        $json = file_get_contents('php://input');
        $obj = json_decode($json, true);

        $phone = $obj['phone'];
        $message = $obj['message'];

        $waService = new WhatsappBlastService;
        $rs = $waService->sendText($phone, $message);

        echo json_encode($rs, JSON_PRETTY_PRINT);
    }

    public function sendAllMessage()
    {
        $json = file_get_contents('php://input');
        $obj = json_decode($json, true);

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

        $message = $obj['message'];

        $query = 'SELECT phone_number FROM tb_customer';
        $this->db->query($query);
        $dataCust = $this->db->fetchAll();

        if (empty($dataCust)) {
            echo json_encode(false, JSON_PRETTY_PRINT);
            return;
        }
        $payload = array(
            'data' => []
        );

        foreach ($dataCust as $cust) {
            $payload['data'][] = array(
                'phone' => $cust['phone_number'],
                'message' => $message
            );
        }
        $waService = new WhatsappBlastService;
        $rs = $waService->sendMultipleText($payload);
        echo json_encode($rs);
    }
}
