<?php

namespace Tests\AppBundle\Unit;

use AppBundle\Entity\Template;
use AppBundle\Entity\User;

/**
 * Class TemplateTest
 *
 * @package AppBundle\Tests\Unit
 */
class TemplateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Template
     */
    private $template;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->template = new Template();
    }

    public function testDefaultUser()
    {
        $user = new User();
        $this->assertInstanceOf(Template::class, $this->template->setName('test@gmail.com'));
        $this->assertEquals('test@gmail.com', $this->template->getName());
        $this->assertInternalType('string', $this->template->getName());
        $this->assertInstanceOf(Template::class, $this->template->setUser($user));
        $this->assertInstanceOf(User::class, $this->template->getUser());
    }
}
