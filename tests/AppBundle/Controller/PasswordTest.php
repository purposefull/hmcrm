<?php

namespace Tests\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class PasswordTest extends BaseTestCase
{
    public static function setUpBeforeClass()
    {
        self::tearDownMysql();
        self::setUpMysql();
        self::setUpMysqlFixtures();
    }

    public function testProfile()
    {
        $client = $this->login();

        $crawler = $client->request('GET', '/profile/change-password');
        $form = $crawler->selectButton('Save changes')->form();
        $form['fos_user_change_password_form[current_password]'] = 'admin';
        $form['fos_user_change_password_form[plainPassword][first]'] = '1111';
        $form['fos_user_change_password_form[plainPassword][second]'] = '1111';
        $client->submit($form);

        $client->request('GET', '/logout');

        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Login')->form();
        $form['_username'] = 'admin';
        $form['_password'] = '1111';
        $client->submit($form);

        $client->request('GET', '/lead/show/1');


        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
}