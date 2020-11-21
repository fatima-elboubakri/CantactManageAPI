<?php

namespace App\Tests;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;
use PHPUnit\Framework\TestCase;

class UtilisateurTest extends TestCase
{

    /**
     * @param Response $response
     */
    public function testGet()
    {
        $response = new Response();
        $client = new Client(
            [
                'defaults' => [
                    'exceptions' => false,
                ],]
        );

        $data = array(
            'id' => 8
        );
        $response = $client->get('http://localhost:8000/cantacts',[
                'body' => json_encode($data),
                ]
        );
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testPOST()
    {
        $response = new Response();
        $client = new Client(
            [
                'defaults' => [
                    'exceptions' => false,
                ], ]
        );

        $dataa =
            [
          //      'id'=> 5,
                'firstname'=> 'testname',
                'lastname'=> 'testlastname',
                'phone'=> '0677789067',
                'mail'=> 'testemail@gmail.com',
                'gender'=> 'male',
                'city'=> 'Marrakech'
            ];

        $response = $client->post('http://localhost:8000/cantact/new',[
                'body' => json_encode($dataa),
                   ]
        );
        $this->assertEquals(201, $response->getStatusCode());
    }


}