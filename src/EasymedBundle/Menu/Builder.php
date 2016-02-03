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
        $menu->addChild('menu.lead', array('route' => 'lead'))->setAttribute('icon', 'fa fa-users')->setAttribute('icon', 'fa fa-users');
        $menu->addChild('menu.contacts', array('route' => 'contact_list'))->setAttribute('icon', 'fa fa-phone');

        // you can also add sub level's to your menu's as follows
//        $menu['menu.contacts']->addChild('menu.person', array('route' => 'person'));
//        $menu['menu.contacts']->addChild('menu.company', array('route' => 'company'));

        $menu->addChild('menu.deal', array('route' => 'deal'))->setAttribute('icon', 'fa fa-usd');
        $menu->addChild('menu.reports', array('route' => 'report'))->setAttribute('icon', 'fa fa-pie-chart');
        $menu->addChild('menu.leadCaptureForm', array('route' => 'lead_capture_form_settings'))->setAttribute('icon', 'fa fa-user');
//        $menu->addChild('menu.import', array('route' => 'deal'))->setAttribute('icon', 'fa fa-download');
//        $menu->addChild('menu.export', array('route' => 'deal'))->setAttribute('icon', 'fa fa-upload');
//        $menu->addChild('menu.products', array('route' => 'deal'))->setAttribute('icon', 'fa fa-cube');
//        $menu->addChild('menu.manageUsers', array('route' => 'deal'))->setAttribute('icon', 'fa fa-unlock-alt');
//        $menu->addChild('menu.emailTemplates', array('route' => 'deal'))->setAttribute('icon', 'fa fa-envelope');
//        $menu->addChild('menu.tasksManagement', array('route' => 'deal'))->setAttribute('icon', 'fa fa-check-square');

        return $menu;
    }
}