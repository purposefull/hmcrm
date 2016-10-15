<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Input\StringInput;

/**
 * Class BaseTestCase
 * @package UmberFirm\Bundle\ManufacturerBundle\Tests
 */
abstract class BaseTestCase extends WebTestCase
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
        self::runAppConsoleCommand("doctrine:database:create");
        self::runAppConsoleCommand("doctrine:schema:update --force");
    }

    /**
     *
     */
    public static function setUpMysqlFixtures()
    {
        self::runAppConsoleCommand("doctrine:fixtures:load --purge-with-truncate --append");
    }

    /**
     *
     */
    public static function tearDownMysql()
    {
        self::runAppConsoleCommand("doctrine:database:drop --force");
    }
}