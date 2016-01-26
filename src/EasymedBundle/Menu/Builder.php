<?php
namespace EasymedBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\MenuItem;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

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
        $this->factory  = $factory;
        $this->router   = $this->container->get('router');

        // Create menu
        $menu = $this->factory->createItem('Header', array(
            'attributes' => array('class' => 'nav metismenu'),
            'id' => 'side-menu'
        ));

        // Add Menu items that are available for user
        $menu->addChild('Lead', array('route' => 'lead'))->setAttribute('icon', 'fa fa-users')->setAttribute('icon', 'fa fa-users');
        $menu->addChild('Contacts', array('route' => 'contact_list'))->setAttribute('icon', 'fa fa-phone');

        // you can also add sub level's to your menu's as follows
        $menu['Contacts']->addChild('Person', array('route' => 'person'));
        $menu['Contacts']->addChild('Company', array('route' => 'company'));

        $menu->addChild('Deals', array('route' => 'deal'))->setAttribute('icon', 'fa fa-rub');
        $menu->addChild('Reports', array('route' => 'deal'))->setAttribute('icon', 'fa fa-pie-chart');
        $menu->addChild('Lead Capture Form', array('route' => 'lead_capture_form_settings'))->setAttribute('icon', 'fa fa-user');
        $menu->addChild('Import', array('route' => 'deal'))->setAttribute('icon', 'fa fa-download');
        $menu->addChild('Export', array('route' => 'deal'))->setAttribute('icon', 'fa fa-upload');
        $menu->addChild('Products', array('route' => 'deal'))->setAttribute('icon', 'fa fa-cube');
        $menu->addChild('Manage Users', array('route' => 'deal'))->setAttribute('icon', 'fa fa-unlock-alt');
        $menu->addChild('Email Templates', array('route' => 'deal'))->setAttribute('icon', 'fa fa-envelope');
        $menu->addChild('Tasks Management', array('route' => 'deal'))->setAttribute('icon', 'fa fa-check-square');

        return $menu;
    }
}