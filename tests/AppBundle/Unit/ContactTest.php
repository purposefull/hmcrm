<?php

namespace Tests\AppBundle\Unit;

use AppBundle\Entity\Contact;
use AppBundle\Entity\User;

/**
 * Class ContactTest
 *
 * @package AppBundle\Tests\Unit
 */
class ContactTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Contact
     */
    private $contact;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->contact = new Contact();
    }

    public function testDefaultUser()
    {
        $this->assertInstanceOf(Contact::class, $this->contact->setName('test@gmail.com'));
        $this->assertEquals('test@gmail.com', $this->contact->getName());
        $this->assertInternalType('string', $this->contact->getName());
        $this->assertInstanceOf(Contact::class, $this->contact->setUser(new User));
        $this->assertInstanceOf(User::class, $this->contact->getUser());
    }
}
