<?php

namespace Tests\AppBundle\Unit;

use AppBundle\Entity\Company;
use AppBundle\Entity\User;
use Doctrine\Common\Collections\Collection;

/**
 * Class CompanyTest
 *
 * @package AppBundle\Tests\Unit
 */
class CompanyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Company
     */
    private $company;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->company = new Company();
    }

    public function testDefaultUser()
    {
        $user = new User();
        $this->assertInstanceOf(Company::class, $this->company->addUser($user));
        $this->assertInstanceOf(Collection::class, $this->company->getUsers());
        $this->assertInstanceOf(User::class, $this->company->getUsers()->first());
        $this->assertInstanceOf(Company::class, $this->company->removeUser($user));
    }

    public function testName()
    {
        $this->assertInstanceOf(Company::class, $this->company->setName('Name'));
        $this->assertEquals('Name', $this->company->getName());
        $this->assertInternalType('string', $this->company->getName());
    }
}
