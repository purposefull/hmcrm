<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Input\StringInput;

/**
 * Class BaseTestCase
 * @package Tests\AppBundle\Controller
 */
class BaseTestCase extends WebTestCase
{

    /**
     * @var
     */
    public static $application;

    /**
     * @param $command
     * @return mixed
     */
    public static function runAppConsoleCommand($command)
    {
        $command = sprintf('%s --env=test', $command);

        return self::getApplication()->run(new StringInput($command));
    }

    /**
     * @return Application
     */
    public static function getApplication()
    {
        if (!self::$application) {
            self::$application = new Application(static::createClient()->getKernel());
            self::$application->setAutoExit(false);
        }

        return self::$application;
    }

    /**
     *
     */
    public static function setUpMysql()
    {
        self::runAppConsoleCommand("doctrine:database:create -q");
        self::runAppConsoleCommand("doctrine:schema:update --force -q");
    }

    /**
     *
     */
    public static function setUpMysqlFixtures()
    {
        self::runAppConsoleCommand("doctrine:fixtures:load -q");
    }

    /**
     *
     */
    public static function tearDownMysql()
    {
        self::runAppConsoleCommand("doctrine:database:drop --force -q");
    }

    public function login()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Login')->form();
        $form['_username'] = 'admin';
        $form['_password'] = 'admin';
        $client->submit($form);

        return $client;
    }
}