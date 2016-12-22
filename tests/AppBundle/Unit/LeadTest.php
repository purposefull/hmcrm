<?php

namespace Tests\AppBundle\Unit;

use AppBundle\Entity\Lead;
use AppBundle\Entity\User;

/**
 * Class LeadTest
 *
 * @package AppBundle\Tests\Unit
 */
class LeadTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Lead
     */
    private $lead;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->lead = new Lead();
    }

    public function testDefaultUser()
    {
        $this->assertInstanceOf(Lead::class, $this->lead->setEmail('test@gmail.com'));
        $this->assertEquals('test@gmail.com', $this->lead->getEmail());
        $this->assertInternalType('string', $this->lead->getEmail());
        $this->assertInstanceOf(Lead::class, $this->lead->setUser(new User));
        $this->assertInstanceOf(User::class, $this->lead->getUser());
    }
}
