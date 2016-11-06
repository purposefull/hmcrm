<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Contact;
use AppBundle\Entity\User;

/**
 * LoadContactData class.
 */
class LoadContactData extends AbstractFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            'AppBundle\DataFixtures\ORM\LoadUserData',
//            'AppBundle\DataFixtures\ORM\LoadPersonData',
//            'AppBundle\DataFixtures\ORM\LoadCompanyData',
        ];
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /** @var User $userAdmin */
        $userAdmin = $this->getReference('user-admin');

        /* @var Person $person1 */
        /* @var Person $person2 */
        /* @var Person $person3 */
//        $person1 = $this->getReference('person-1');
//        $person2 = $this->getReference('person-2');
//        $person3 = $this->getReference('person-3');

        /* @var Company $company1 */
        /* @var Company $company2 */
        /* @var Company $company3 */
//        $company1 = $this->getReference('company-1');
//        $company2 = $this->getReference('company-2');
//        $company3 = $this->getReference('company-3');

        $contact1 = (new Contact())
//            ->setCompany($company1)
//            ->setPerson($person1)
            ->setUser($userAdmin)
            ->setType(1);
        $this->setReference('contact-1', $contact1);
        $manager->persist($contact1);

        $contact2 = (new Contact())
//            ->setCompany($company2)
//            ->setPerson($person2)
            ->setUser($userAdmin)
            ->setType(2);
        $this->setReference('contact-2', $contact1);
        $manager->persist($contact2);

        $contact3 = (new Contact())
//            ->setCompany($company3)
//            ->setPerson($person3)
            ->setUser($userAdmin)
            ->setType(2);
        $this->setReference('contact-3', $contact1);
        $manager->persist($contact3);

        $manager->flush();
    }
}
