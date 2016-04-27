<?php

namespace EasymedBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use EasymedBundle\Entity\Person;

/**
 * LoadPersonData class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class LoadPersonData extends AbstractFixture
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $person1 = (new Person())
            ->setFirstName('Сергей')
            ->setLastName('Иванов')
            ->setCompanyName('Лукойл')
            ->setTitle('Лукойл')
            ->setCustomerStatus(1)
            ->setProspectStatus(1)
            ->setEmail('seregaaa@gmail.com')
            ->setMobilePhone('+380950945789')
            ->setWorkPhone('+38098453345')
            ->setAddress('проулок Победы 12')
            ->setCity('Воронеж')
            ->setRegion('Воронеж')
            ->setCountry('Россия')
            ->setTags('Новый клиент, перспективный');
        $this->setReference('person-1', $person1);
        $manager->persist($person1);

        $person2 = (new Person())
            ->setFirstName('Мария')
            ->setLastName('Русланова')
            ->setCompanyName('Диджитал Солюшен')
            ->setTitle('Диджитал Солюшен')
            ->setCustomerStatus(2)
            ->setProspectStatus(2)
            ->setEmail('mariyaaa@gmail.com')
            ->setMobilePhone('+38090941289')
            ->setWorkPhone('+38098723345')
            ->setAddress('проулок Свобооды 72')
            ->setCity('Киев')
            ->setRegion('Киев')
            ->setCountry('Украина')
            ->setTags('Старый, добрый клиент');
        $this->setReference('person-2', $person2);
        $manager->persist($person2);

        $person3 = (new Person())
            ->setFirstName('Игорь')
            ->setLastName('Лапун')
            ->setCompanyName('Мистраль')
            ->setTitle('Мистраль')
            ->setCustomerStatus(3)
            ->setProspectStatus(3)
            ->setEmail('iga_mistrag@gmail.com')
            ->setMobilePhone('+38093941289')
            ->setWorkPhone('+38098543345')
            ->setAddress('улица Центральная 18, кв 19')
            ->setCity('Харьков')
            ->setRegion('Харьков')
            ->setCountry('Украина')
            ->setTags('Старый, добрый клиент');
        $this->setReference('person-3', $person3);
        $manager->persist($person3);

        $manager->flush();
    }
}
