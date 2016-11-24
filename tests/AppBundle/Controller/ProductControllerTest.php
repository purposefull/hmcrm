<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Tests\AppBundle\Controller\BaseTestCase;

require_once 'BaseTestCase.php';

class ProductControllerTest extends BaseTestCase
{
    public static function setUpBeforeClass()
    {
        self::tearDownMysql();
        self::setUpMysql();
        self::setUpMysqlFixtures();
    }

    public function testIndex()
    {
        $client = $this->login();

        $client->request('GET', '/product/');

        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testShow()
    {
        $client = $this->login();

        $client->request('GET', '/product/show/1');

        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testEdit()
    {
        $client = $this->login();

        $client->request('GET', '/product/edit/1');

        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testDelete()
    {
        $client = $this->login();

        $client->request('GET', '/product/delete/3');

        static::assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}