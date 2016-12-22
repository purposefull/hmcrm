<?php

namespace Tests\AppBundle\Unit;

use AppBundle\Entity\Company;
use AppBundle\Entity\User;

/**
 * Class CompanyTest
 *
 * @package AppBundle\Tests\Unit
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var User
     */
    private $user;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->user = new User();
    }

    public function testDefaultUser()
    {
        $company = new Company();
        $this->assertInstanceOf(User::class, $this->user->setEmail('test@gmail.com'));
        $this->assertEquals('test@gmail.com', $this->user->getEmail());
        $this->assertInternalType('array', $this->user->getRoles());
        $this->assertInstanceOf(User::class, $this->user->setCompany($company));
    }

    public function testName()
    {
        $this->assertInstanceOf(User::class, $this->user->setPassword('Name'));
        $this->assertEquals('Name', $this->user->getPassword());
        $this->assertInternalType('string', $this->user->getPassword());
    }
}
