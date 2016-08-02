<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Contact;
use AppBundle\Entity\Deal;
use AppBundle\Entity\User;

/**
 * LoadDealData class.
 *
 */
class LoadDealData extends AbstractFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            'AppBundle\DataFixtures\ORM\LoadUserData',
//            'AppBundle\DataFixtures\ORM\LoadPersonData',
            'AppBundle\DataFixtures\ORM\LoadCompanyData',
            'AppBundle\DataFixtures\ORM\LoadContactData',
        ];
    }

    public function load(ObjectManager $manager)
    {
        /** @var User $userAdmin */
        $userAdmin = $this->getReference('user-admin');

        /** @var Contact $contact1 */
        /* @var Contact $contact2 */
        /* @var Contact $contact3 */
        $contact1 = $this->getReference('contact-1');
        $contact2 = $this->getReference('contact-2');
        $contact3 = $this->getReference('contact-3');

        $deal1 = (new Deal())
            ->setName('Наша первая сделка')
            ->setStage(1)
            ->setValue(1000)
            ->setCurrency('$')
            ->setSource('Наш источник')
            ->setTags('Первая сделка')
            ->setUser($userAdmin)
            ->setContact($contact1);
        $manager->persist($deal1);
        $this->setReference('deal-1', $deal1);

        $deal2 = (new Deal())
            ->setName('Наша вторая сделка')
            ->setStage(2)
            ->setValue(2000)
            ->setCurrency('$')
            ->setSource('Наш источник')
            ->setTags('Вторая сделка')
            ->setUser($userAdmin)
            ->setContact($contact1);
        $manager->persist($deal2);
        $this->setReference('deal-2', $deal1);

        $deal3 = (new Deal())
            ->setName('Наша третья сделка')
            ->setStage(3)
            ->setValue(3000)
            ->setCurrency('$')
            ->setSource('Наш источник')
            ->setTags('Третья сделка')
            ->setUser($userAdmin)
            ->setContact($contact2);
        $manager->persist($deal3);
        $this->setReference('deal-3', $deal3);

        $deal4 = (new Deal())
            ->setName('Наша четвертая сделка')
            ->setStage(4)
            ->setValue(4000)
            ->setCurrency('$')
            ->setSource('Наш источник')
            ->setTags('Четвертая сделка')
            ->setUser($userAdmin)
            ->setContact($contact3);
        $manager->persist($deal4);
        $this->setReference('deal-4', $deal4);

        $manager->flush();
    }
}
