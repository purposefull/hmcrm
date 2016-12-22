<?php

namespace Tests\AppBundle\Unit;

use AppBundle\Entity\Product;
use AppBundle\Entity\User;

/**
 * Class ProductTest
 *
 * @package AppBundle\Tests\Unit
 */
class ProductTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Product
     */
    private $product;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->product = new Product();
    }

    public function testDefaultUser()
    {
        $this->assertInstanceOf(Product::class, $this->product->setName('test@gmail.com'));
        $this->assertEquals('test@gmail.com', $this->product->getName());
        $this->assertInternalType('string', $this->product->getName());
        $this->assertInstanceOf(Product::class, $this->product->setUser(new User));
        $this->assertInstanceOf(User::class, $this->product->getUser());
    }
}
