<?php
namespace EasymedBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DoctorType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', 'text');
        $builder->add('lastName', 'text');
        $builder->add('specialization', 'text');
        $builder->add('submit', 'submit');

        $builder->setRequired(false);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'easymed_doctor';
    }
}