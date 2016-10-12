<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
//        $client = static::createClient();
//
//        $crawler = $client->request('GET', '/login');
//
//        $this->assertEquals(200, $client->getResponse()->getStatusCode());
//        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }

    public function testExportJson()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Login')->form();
        $form['_username'] = 'admin';
        $form['_password'] = 'admin';
        $crawler = $client->submit($form);

//        $crawler = $client->request('GET', '/export_json');

//        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testExportPdf()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Login')->form();
        $form['_username'] = 'admin';
        $form['_password'] = 'admin';
        $crawler = $client->submit($form);

        $crawler = $client->request('GET', '/export_pdf');

        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testExportXml()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Login')->form();
        $form['_username'] = 'admin';
        $form['_password'] = 'admin';
        $crawler = $client->submit($form);

        $crawler = $client->request('GET', '/export_xml');

        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

}
