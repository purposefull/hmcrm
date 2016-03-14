<?php

namespace EasymedBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PatientType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', 'text');
        $builder->add('lastName', 'text');
        $builder->add('birthday', 'date', array(
            'input' => 'timestamp',
        ));
        $builder->add('phone', 'integer');
        $builder->add('email', 'text');
        $builder->add('submit', 'submit');

        $builder->setRequired(false);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'easymed_patient';
    }
}
