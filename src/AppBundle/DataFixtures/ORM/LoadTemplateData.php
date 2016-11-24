<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Template;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

/**
 * LoadTemplateData class.
 */
class LoadTemplateData extends AbstractFixture
{
    /**
     * {@inheritdoc}
     */
//    public function getDependencies()
//    {
//        return [
////            'AppBundle\DataFixtures\ORM\LoadTemplateData',
//        ];
//    }

    public function load(ObjectManager $manager)
    {
        /** @var User $userAdmin */
        $userAdmin = $this->getReference('user-admin');

        $template1 = new Template();
        $template1->setName('god');
        $template1->setCode('twig');
        $template1->setUser($userAdmin);
        $manager->persist($template1);

        $template2 = new Template();
        $template2->setName('seregaaa@gmail.com');
        $template2->setCode('sadsadsa');
        $template2->setUser($userAdmin);
        $manager->persist($template2);

        $template3 = new Template();
        $template3->setName('seregaaa@gmail.com');
        $template3->setCode('sadsadsa');
        $template3->setUser($userAdmin);
        $manager->persist($template3);

        $manager->flush();
    }
}
