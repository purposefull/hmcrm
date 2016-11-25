<?php

namespace Tests\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class TemplateControllerTest extends BaseTestCase
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

        $client->request('GET', '/email_template');

        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testShow()
    {
        $client = $this->login();

        $client->request('GET', '/email_template/show/1');

        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testEdit()
    {
        $client = $this->login();

        $client->request('GET', '/email_template/edit/1');

        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testDelete()
    {
        $client = $this->login();

        $client->request('GET', '/email_template/delete/3');

        static::assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}