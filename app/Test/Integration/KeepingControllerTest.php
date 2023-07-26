<?php
use Faker\Factory as FakerFactory;

use PHPUnit\Framework\TestCase;
use NextG\Autoreply\Controllers\KeepingController;
use GuzzleHttp\Client;
class KeepingControllerTest extends TestCase
{

    private $keepingController;

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
        $faker = FakerFactory::create('id_ID');

        for($i = 0; $i <= 2; $i++) {
            $idMenu = $this->idMenu[random_int(1, 11)];
            $inputKeeping[] = [
                'id' => $idMenu,
                'custPhoneNumber' => '085714342528',
                'tanggal' => '2023-07-26',
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


    protected function setUp(): void
    {
        $this->keepingController = new KeepingController();
    }

    public function testSaveKeeping()
    {
        $keepings = $this->generate100FakeInputKeeping();

        $url = 'http://localhost/autoreply/save-keeping'; // Replace with the actual endpoint URL.





        // Convert the PHP array to JSON.
        $jsonData = json_encode($keepings);

        // Set the HTTP headers for the request.
        $headers = [
            'Content-Type' => 'application/json',
            'Content-Length' => strlen($jsonData),
        ];

        // Create a new Guzzle client.
        $client = new Client();

        try {
            // Make the HTTP POST request using Guzzle.
            $response = $client->post($url, [
                'headers' => $headers,
                'body' => $jsonData,
            ]);

            // Assert the response status code is 200 (OK) for successful requests.
            $this->assertEquals(200, $response->getStatusCode());

            // Optionally, you can assert the response content if needed.
            // $responseData = json_decode($response->getBody(), true);
            // $this->assertEquals('success', $responseData['status']);
        } catch (ClientException $e) {
            // Capture the exception for error responses (e.g., 400 Bad Request).
            $response = $e->getResponse();

            // Assert the response status code is 400 (Bad Request) for error responses.
            $this->assertEquals(400, $response->getStatusCode());

            // Get the response body as a JSON string and decode it.
            $responseData = json_decode($response->getBody(), true);


        }

    }
}
