<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class RequestControllerTest extends WebTestCase
{
    public function testRequestPage () {
        $client = static::createClient();
        $client->request('GET','/demande');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
