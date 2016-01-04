<?php

namespace EasymedBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customerStatus')
            ->add('prospectStatus')
            ->add('firstName')
            ->add('lastName')
            ->add('companyName')
            ->add('title')
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
            'data_class' => 'EasymedBundle\Entity\Person'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'easymedbundle_person';
    }
}
