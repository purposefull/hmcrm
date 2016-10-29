<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Template;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use AppBundle\Entity\Product;

/**
 * LoadProductData class.
 */
class LoadProductData extends AbstractFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        /** @var User $userAdmin */
        $userAdmin = $this->getReference('user-admin');

        $product1 = new Product();
        $product1->setName('Upsell message');
        $product1->setCode("{{ 'twig' }}");
        $product1->setUser($userAdmin);
        $manager->persist($product1);

        $product2 = new Product();
        $product2->setName('me');
        $product2->setCode('sadsadsa');
        $product2->setCurrency('$');
        $manager->persist($product2);

        $product3 = new Product();
        $product3->setName('Close message');
        $product3->setCode("{{ 'twig' }}");
        $product3->setUser($userAdmin);
        $manager->persist($product3);

        $product4 = new Product();
        $product4->setName('продукт');
        $product4->setPrice(1000);
        $product4->setCurrency('$');
        $product4->setUser($userAdmin);
        $manager->persist($product4);
        $this->setReference('product-4', $product4);

        $product5 = new Product();
        $product5->setName('продукт');
        $product5->setPrice(1000);
        $product5->setCurrency('$');
        $product5->setUser($userAdmin);
        $manager->persist($product5);
        $this->setReference('product-5', $product5);


        $manager->flush();
    }
}
