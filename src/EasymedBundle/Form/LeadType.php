<?php

namespace EasymedBundle\Form;

use EasymedBundle\Entity\Lead;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LeadType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('submit', 'submit')
            ->add('firstName')
            ->add('lastName', 'text', array(
                'label' => 'Last Name* '
            ))
            ->add('companyName')
            ->add('title')
            ->add('leadStatus', 'choice', array(
                'choices' => Lead::valuesOfStatus()
            ))
            ->add('email')
            ->add('mobilePhone')
            ->add('workPhone')
            ->add('address')
            ->add('city')
            ->add('zipCode')
            ->add('region')
            ->add('country')
            ->add('tags')
        ;

    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EasymedBundle\Entity\Lead'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lead';
    }
}
