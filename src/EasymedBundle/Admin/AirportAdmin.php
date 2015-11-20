<?php

namespace SkyFlow\AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AirportAdmin extends Admin
{
    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('city', null, ['label' => 'Main city served'])
            ->add('country', null, ['label' => 'Country'])
            ->add('ICAO', null, ['label' => 'ICAO'])
            ->add('IATA', null, ['label' => 'IATA'])
            ->add('title', null, ['label' => 'Airport Name'])
            ->add('exportCustomsID', null, ['label' => 'ExportCustomsID'])
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('city')
            ->add('country')
            ->add('ICAO')
            ->add('IATA')
            ->add('title')
            ->add('exportCustomsID')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('city')
            ->add('country')
            ->add('ICAO')
            ->add('IATA')
            ->add('title')
            ->add('exportCustomsID')
        ;
    }
}
