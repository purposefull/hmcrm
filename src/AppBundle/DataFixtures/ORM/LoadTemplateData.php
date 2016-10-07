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

        $lead1 = (new Template())
            ->setName('Upsell message')
            ->setCode("{{ 'twig' }}")
            ->setUser($userAdmin);
        $manager->persist($lead1);

        $lead2 = new Template();
        $lead2->setCode('sadsadsa');
//        $lead2->setName('Downsell message')
//            ->set("{{ 'twig' }}")
//            ->setUser($userAdmin);
        $manager->persist($lead2);

        $lead3 = (new Template())
            ->setName('Close message')
            ->setCode("{{ 'twig' }}")
            ->setUser($userAdmin);
        $manager->persist($lead3);

        $manager->flush();
    }
}
