<?php

namespace App\Tests;

use function PHPUnit\Framework\assertEquals;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ApiTest extends WebTestCase
{
    public function testAdd(): void
    {
        $client = static::createClient();
        $client->jsonRequest('POST', '/api/calculator', ['number1' => 1, 'number2' => 2, 'operator' => '+']);
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this > assertEquals('{"result":3}', $client->getResponse()->getContent());
    }

    public function testSubtract(): void
    {
        $client = static::createClient();
        $client->jsonRequest('POST', '/api/calculator', ['number1' => 4, 'number2' => 2, 'operator' => '-']);
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this > assertEquals('{"result":2}', $client->getResponse()->getContent());
    }

    public function testMultiply(): void
    {
        $client = static::createClient();
        $client->jsonRequest('POST', '/api/calculator', ['number1' => 3, 'number2' => 3, 'operator' => '*']);
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this > assertEquals('{"result":9}', $client->getResponse()->getContent());
    }

    public function testDivide(): void
    {
        $client = static::createClient();
        $client->jsonRequest('POST', '/api/calculator', ['number1' => 4, 'number2' => 2, 'operator' => '/']);
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this > assertEquals('{"result":2}', $client->getResponse()->getContent());
    }

    public function testDivisionByZero(): void
    {
        $client = static::createClient();
        $client->jsonRequest('POST', '/api/calculator', ['number1' => 1, 'number2' => 0, 'operator' => '/']);
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $client->getResponse()->getStatusCode());
        $this > assertEquals('{"validation_errors":["Division by zero is not allowed"]}', $client->getResponse()->getContent());
    }

    public function testMissingParameters(): void
    {
        $client = static::createClient();
        $client->jsonRequest('POST', '/api/calculator');

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $client->getResponse()->getStatusCode());
        $this > assertEquals('{"validation_errors":{"number1":["This value should not be null."],"number2":["This value should not be null."],"operator":["This value should not be null."]}}', $client->getResponse()->getContent());
    }

    public function testInvalidOperator(): void
    {
        $client = static::createClient();
        $client->jsonRequest('POST', '/api/calculator', ['number1' => 1, 'number2' => 0, 'operator' => 'x']);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $client->getResponse()->getStatusCode());
        $this > assertEquals('{"validation_errors":{"operator":["+,-,*,\/ are the only allowed operators"]}}', $client->getResponse()->getContent());
    }
}
