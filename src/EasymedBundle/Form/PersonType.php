<?php

namespace EasymedBundle\Form;

use EasymedBundle\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', 'text', array(
                'label' => 'firstname',
            ))
            ->add('lastName', 'text', array(
                'label' => 'lastName',
            ))
            ->add('companyName', 'text', array(
                'label' => 'company.title',
            ))
            ->add('title', 'text', array(
                'label' => 'title',
            ))
            ->add('customerStatus', 'choice', array(
                'choices' => Person::valuesOfCustomerStatus(),
                'label' => 'customerstatus',
            ))
            ->add('prospectStatus', 'choice', array(
                'choices' => Person::valuesOfProspectStatus(),
                'label' => 'prospectstatus',
            ))
            ->add('email', 'text', array(
                'label' => 'email',
            ))
            ->add('mobilePhone', 'text', array(
                'label' => 'mobilephone',
            ))
            ->add('workPhone', 'text', array(
                'label' => 'workphone',
            ))
            ->add('address', 'text', array(
                'label' => 'address',
            ))
            ->add('city', 'text', array(
                'label' => 'city',
            ))
            ->add('zipCode', 'text', array(
                'label' => 'zipcode',
            ))
            ->add('region', 'text', array(
                'label' => 'region',
            ))
            ->add('country', 'text', array(
                'label' => 'country',
            ))
            ->add('tags', 'text', array(
                'label' => 'tags',
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
            'data_class' => 'EasymedBundle\Entity\Person',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'person';
    }
}
