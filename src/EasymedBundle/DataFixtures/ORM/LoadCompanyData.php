<?php

namespace EasymedBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use EasymedBundle\Entity\Company;

/**
 * LoadCompanyData class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class LoadCompanyData extends AbstractFixture
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $company1 = (new Company())
            ->setName('Digital Solution')
            ->setCustomerStatus(1)
            ->setProspectStatus(1)
            ->setEmail('digital@gmail.com')
            ->setMobilePhone('+380984455678')
            ->setWorkPhone('+3800934561')
            ->setAddress('улица Декабристов 19, кв 2')
            ->setCity('Днепропетровск')
            ->setRegion('Днепропетровск')
            ->setTags('Успешная компания');
        $manager->persist($company1);

        $company2 = (new Company())
            ->setName('Fixing media')
            ->setCustomerStatus(2)
            ->setProspectStatus(2)
            ->setEmail('fixing-media@gmail.com')
            ->setMobilePhone('+380988956342')
            ->setWorkPhone('+38094054533')
            ->setAddress('улица Зеленая 29, кв 209')
            ->setCity('Киев')
            ->setRegion('Киев')
            ->setTags('Пресса');
        $manager->persist($company2);

        $company3 = (new Company())
            ->setName('Product firm')
            ->setCustomerStatus(3)
            ->setProspectStatus(3)
            ->setEmail('product@gmail.com')
            ->setMobilePhone('+380978909111')
            ->setWorkPhone('+3809845111')
            ->setAddress('улица Железная 19, кв 90')
            ->setCity('Львов')
            ->setRegion('Львов')
            ->setTags('Успешная компания');
        $manager->persist($company3);

        $manager->flush();
    }
}
