<?php

namespace Tests\AppBundle;

use Tests\AppBundle\Controller\BaseTestCase;

/**
 * Class DatabaseSchemaTest
 *
 * @package UmberFirm\Bundle\ShopBundle\Tests\Functional\Controller
 */
class DatabaseSchemaTest extends BaseTestCase
{
    public static function setUpBeforeClass()
    {
        self::runAppConsoleCommand('doctrine:database:drop -q --force');
        self::runAppConsoleCommand('doctrine:database:create -q');
        self::runAppConsoleCommand('doctrine:migrations:migrate -q');
    }

    /**
     * Test database schema
     */
    public function testSchema()
    {
        $code = self::runAppConsoleCommand('doctrine:schema:validate -q');
        $this->assertEquals(0, $code, 'Database schema is not valid. Check DoctrineMigrations directory.');
    }
}
