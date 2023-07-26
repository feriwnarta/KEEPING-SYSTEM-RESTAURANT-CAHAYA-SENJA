<?php

namespace NextG\Autoreply\Controllers;

use Faker\Factory;
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

    private $idMenu = [
        '552b7b60-082a-11ee-ac62-ab1be0572d2d',
        '574777f0-082c-11ee-a8c5-9f9782742eec',
        '59f1f150-08dd-11ee-9bac-6bd2d58f24e8',
        '5dae1510-082c-11ee-8a63-bf9fbc4dae36',
        '61bf1b60-082c-11ee-bcc7-5593fc83d43f',
        '733e4be0-082c-11ee-b428-c1904869b1cb',
        '7d5a4e30-082c-11ee-bb5f-737f439f898b',
        '82040100-082c-11ee-ab8b-415a2d0c1048',
        'a0a13a20-082c-11ee-ad08-3f030980757b',
        'a7a03170-082c-11ee-9136-330848c1a69a',
        'cd2e98c0-082c-11ee-87a1-956863df12b9',
        'd7a2b5c0-082c-11ee-92ba-af4c2ce4f31c',
    ];


    private function generate100FakeInputKeeping(){
        $inputKeeping = array();
        $faker = Factory::create('id_ID');

        for($i = 0; $i <= 1; $i++) {
            $idMenu = $this->idMenu[random_int(1, 11)];
            $inputKeeping[] = [
                'id' => $idMenu,
                'custPhoneNumber' => '085714342528',
                'tanggal' => '26/07/2023',
                'count' => 2,
                'custName' => 'feri',

            ];
        }

        return $inputKeeping;

    }

    function generateRandomPhoneNumber() {
        $faker = Faker\Factory::create('id_ID');
        return $faker->numerify('08##########'); // Replace '#' with a random digit.

    }

    function testKeep() {
        $keepings = $this->generate100FakeInputKeeping();

        $url = 'http://localhost/autoreply/save-keeping'; // Replace with the actual endpoint URL.




        // Convert the PHP array to JSON.
        $jsonData = json_encode($keepings);

        // Set the HTTP headers for the request.
        $headers = [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData),
        ];

        // Create a stream context with the JSON data in the request body.
        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => implode("\r\n", $headers),
                'content' => $jsonData,
            ],
        ]);

        // Make the HTTP request.
        $response = file_get_contents($url, false, $context);

        var_dump($response);


    }
}
