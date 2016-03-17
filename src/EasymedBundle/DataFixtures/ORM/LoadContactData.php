<?php

namespace EasymedBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use EasymedBundle\Entity\Company;
use EasymedBundle\Entity\Contact;
use EasymedBundle\Entity\Person;
use EasymedBundle\Entity\User;

/**
 * LoadContactData class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class LoadContactData extends AbstractFixture
{
    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            'AppBundle\DataFixtures\ORM\LoadUserData',
            'AppBundle\DataFixtures\ORM\LoadPersonData',
            'AppBundle\DataFixtures\ORM\LoadCompanyData',
        ];
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /** @var User $userAdmin */
        $userAdmin = $this->getReference('user-admin');

        /** @var Person $person1 */
        /** @var Person $person2 */
        /** @var Person $person3 */
        $person1 = $this->getReference('person-1');
        $person2 = $this->getReference('person-2');
        $person3 = $this->getReference('person-3');

        /** @var Company $company1 */
        /** @var Company $company2 */
        /** @var Company $company3 */
        $company1 = $this->getReference('company-1');
        $company2 = $this->getReference('company-2');
        $company3 = $this->getReference('company-3');

        $contact1 = (new Contact())
            ->setCompany($company1)
            ->setPerson($person1)
            ->setUser($userAdmin)
            ->setType(1);
        $manager->persist($contact1);

        $contact2 = (new Contact())
            ->setCompany($company2)
            ->setPerson($person2)
            ->setUser($userAdmin)
            ->setType(2);
        $manager->persist($contact2);

        $contact3 = (new Contact())
            ->setCompany($company3)
            ->setPerson($person3)
            ->setUser($userAdmin)
            ->setType(3);
        $manager->persist($contact3);

        $manager->flush();
    }
}
