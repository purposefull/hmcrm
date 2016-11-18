<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Builder class.
 */
class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * Builds main menu.
     */
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $this->factory = $factory;
        $this->router = $this->container->get('router');

        // Create menu
        $menu = $this->factory->createItem('Header', [
            'attributes' => [
                'class' => 'nav metismenu',
            ],
            'id' => 'side-menu',
        ]);

        // Add Menu items that are available for user
        $menu->addChild('menu.lead', [
            'route' => 'lead',
        ])->setAttribute('icon', 'fa fa-users');

        $menu->addChild('menu.contacts', [
            'route' => 'contact_list',
        ])->setAttribute('icon', 'fa fa-phone');

        $menu->addChild('menu.deal', [
            'route' => 'deal',
        ])->setAttribute('icon', 'fa fa-usd');

        $menu->addChild('menu.task', [
            'route' => 'task',
        ])->setAttribute('icon', 'fa fa-check-square-o');

        $menu->addChild('menu.calendar', [
            'route' => 'calendar',
        ])->setAttribute('icon', 'fa fa-calendar');

        $menu->addChild('menu.reports', [
            'route' => 'report',
        ])->setAttribute('icon', 'fa fa-pie-chart');

        $menu->addChild('menu.leadCaptureForm', [
            'route' => 'lead_capture_form_settings',
        ])->setAttribute('icon', 'fa fa-user');

        $menu->addChild('menu.emailTemplate', [
            'route' => 'email_template',
        ])->setAttribute('icon', 'fa fa-file-text');

        $menu->addChild('menu.product', [
            'route' => 'product',
        ])->setAttribute('icon', 'fa fa-product-hunt');

        $menu->addChild('menu.import', [
            'route' => 'import',
        ])->setAttribute('icon', 'fa fa-download');

        $menu->addChild('menu.export', [
            'route' => 'export',
        ])->setAttribute('icon', 'fa fa-upload');

        $menu->addChild('Settings', [
            'route' => 'settings',
        ])->setAttribute('icon', 'fa fa-cog');

        return $menu;
    }
}
