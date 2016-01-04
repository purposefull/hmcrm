<?php

namespace EasymedBundle\Form;

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
            ->add('firstName')
            ->add('lastName')
            ->add('companyName')
            ->add('title')
            ->add('leadStatus')
            ->add('email')
            ->add('mobilePhone')
            ->add('workPhone')
            ->add('address')
            ->add('city')
            ->add('zipCode')
            ->add('region')
            ->add('country')
            ->add('tags')
            ->add('source')
            ->add('createdAt')
            ->add('updatedAt')
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
        return 'easymedbundle_lead';
    }
}
