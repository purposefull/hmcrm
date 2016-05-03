<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        if (!$userManager->findUserByUsername('admin')) {
            $user = $userManager->createUser();
            $user->setUsername('admin');
            $user->setEmail('admin@admin');
            $user->setPlainPassword('admin');
            $user->setEnabled(true);
            $user->setRoles(array('ROLE_SUPER_ADMIN'));
            $this->setReference('user-admin', $user);
            $userManager->updateUser($user, true);
        }
    }
}
