<?php

namespace EasymedBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use EasymedBundle\Entity\User;

/**
 * LoadUserData class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class LoadUserData extends AbstractFixture
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userAdmin = (new User())
            ->setUsername('admin')
            ->setEmail('admin@admin.com')
            ->setPlainPassword('admin')
            ->setEnabled(true)
            ->setRoles([
                'ROLE_SUPER_ADMIN',
            ]);
        $this->setReference('user-admin', $userAdmin);
        $manager->persist($userAdmin);

        $userSecondAdmin = (new User())
            ->setUsername('second_admin')
            ->setEmail('second_admin@admin.com')
            ->setPlainPassword('second_admin')
            ->setEnabled(true)
            ->setRoles([
                'ROLE_SUPER_ADMIN',
            ]);
        $this->setReference('user-second-admin', $userSecondAdmin);
        $manager->persist($userSecondAdmin);

        $manager->flush();
    }
}
