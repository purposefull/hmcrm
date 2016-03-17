<?php

namespace EasymedBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EasymedBundle\Entity\Contact;
use EasymedBundle\Entity\Deal;
use EasymedBundle\Entity\User;

/**
 * LoadDealData class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class LoadDealData extends AbstractFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            'EasymedBundle\DataFixtures\ORM\LoadUserData',
            'EasymedBundle\DataFixtures\ORM\LoadPersonData',
            'EasymedBundle\DataFixtures\ORM\LoadCompanyData',
            'EasymedBundle\DataFixtures\ORM\LoadContactData',
        ];
    }

    public function load(ObjectManager $manager)
    {
        /** @var User $userAdmin */
        $userAdmin = $this->getReference('user-admin');

        /** @var Contact $contact1 */
        /** @var Contact $contact2 */
        /** @var Contact $contact3 */
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
