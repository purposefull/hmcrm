<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\MenuItem;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Builder class
 *
 */
class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;

    /**
     * Builds main menu
     */
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $this->factory = $factory;
        $this->router  = $this->container->get('router');

        // Create menu
        $menu = $this->factory->createItem('Header', [
            'attributes' => [
                'class' => 'nav metismenu',
            ],
            'id'         => 'side-menu',
        ]);

        // Add Menu items that are available for user
        $menu->addChild('menu.lead', [
            'route' => 'lead',
        ])->setAttribute('icon', 'fa fa-users');

        $menu->addChild('menu.contacts', [
            'route' => 'contact_list',
        ])->setAttribute('icon', 'fa fa-phone');

        // you can also add sub level's to your menu's as follows
        //        $menu['menu.contacts']->addChild('menu.person', ['route' => 'person']);
        //        $menu['menu.contacts']->addChild('menu.company', ['route' => 'company']));

        $menu->addChild('menu.deal', [
            'route' => 'deal',
        ])->setAttribute('icon', 'fa fa-usd');

        $menu->addChild('menu.reports', [
            'route' => 'report',
        ])->setAttribute('icon', 'fa fa-pie-chart');

        $menu->addChild('menu.leadCaptureForm', [
            'route' => 'lead_capture_form_settings',
        ])->setAttribute('icon', 'fa fa-user');

        $menu->addChild('menu.import', [
            'route' => 'import',
        ])->setAttribute('icon', 'fa fa-user');

        $menu->addChild('menu.tasks', [
            'route' => 'integration_index',
        ])->setAttribute('icon', 'fa fa-user');

        $menu->addChild('menu.email', [
            'route' => 'email_index',
        ])->setAttribute('icon', 'fa fa-user');

        //        $menu->addChild('menu.import', ['route' => 'deal'])->setAttribute('icon', 'fa fa-download');
        //        $menu->addChild('menu.export', ['route' => 'deal'])->setAttribute('icon', 'fa fa-upload');
        //        $menu->addChild('menu.products', ['route' => 'deal'])->setAttribute('icon', 'fa fa-cube');
        //        $menu->addChild('menu.manageUsers', ['route' => 'deal'])->setAttribute('icon', 'fa fa-unlock-alt');
        //        $menu->addChild('menu.emailTemplates', ['route' => 'deal'])->setAttribute('icon', 'fa fa-envelope');
        //        $menu->addChild('menu.tasksManagement', ['route' => 'deal'])->setAttribute('icon', 'fa fa-check-square');

        return $menu;
    }
}
