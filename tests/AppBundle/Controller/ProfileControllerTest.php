<?php

namespace Tests\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class ProfileControllerTest extends BaseTestCase
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

        $crawler = $client->request('GET', '/profile/edit');
        $form = $crawler->selectButton('Save changes')->form();
        $form['fos_user_profile_form[username]'] = 'admin';
        $form['fos_user_profile_form[email]'] = '';
        $form['phoneNumber'] = '';
        $form['fos_user_profile_form[country]'] = 'BY';
        $client->submit($form);

        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
}
