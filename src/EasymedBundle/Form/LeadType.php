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
            ->add('submit', 'submit', array(
                'label' => 'name'
            ))
            ->add('firstName', 'text', array(
                'label' => 'firstname'
            ))
            ->add('lastName', 'text', array(
                'label' => 'lastName'
            ))
            ->add('companyName', 'text', array(
                'label' => 'company.title'
            ))
            ->add('title', 'text', array(
                'label' => 'title'
            ))
            ->add('leadStatus', 'choice', array(
                'choices' => Lead::valuesOfStatus(),
                'label' => 'lead.status'
            ))
            ->add('email', 'text', array(
                'label' => 'email'
            ))
            ->add('mobilePhone', 'text', array(
                'label' => 'mobilephone'
            ))
            ->add('workPhone', 'text', array(
                'label' => 'workphone'
            ))
            ->add('address', 'text', array(
                'label' => 'address'
            ))
            ->add('city', 'text', array(
                'label' => 'city'
            ))
            ->add('zipCode', 'text', array(
                'label' => 'zipcode'
            ))
            ->add('region', 'text', array(
                'label' => 'region'
            ))
            ->add('country', 'text', array(
                'label' => 'country'
            ))
            ->add('tags', 'text', array(
                'label' => 'tags'
            ))
        ;

        $builder->setRequired(false);
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
