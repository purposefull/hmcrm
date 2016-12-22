<?php

namespace Tests\AppBundle\Unit;

use AppBundle\Entity\Deal;
use AppBundle\Entity\User;

/**
 * Class DealTest
 *
 * @package AppBundle\Tests\Unit
 */
class DealTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Deal
     */
    private $deal;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->deal = new Deal();
    }

    public function testDefaultUser()
    {
        $this->assertInstanceOf(Deal::class, $this->deal->setName('test@gmail.com'));
        $this->assertEquals('test@gmail.com', $this->deal->getName());
        $this->assertInternalType('string', $this->deal->getName());
        $this->assertInstanceOf(Deal::class, $this->deal->setUser(new User));
        $this->assertInstanceOf(User::class, $this->deal->getUser());
    }
}
