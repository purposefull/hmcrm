<?php

namespace EasymedBundle\Form;

use EasymedBundle\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompanyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'name',
            ))
            ->add('customerStatus', 'choice', array(
                'choices' => Company::valuesOfCustomerStatus(),
                'label' => 'customerstatus',
            ))
            ->add('prospectStatus', 'choice', array(
                'choices' => Company::valuesOfProspectStatus(),
                'label' => 'prospectstatus',
            ))
            ->add('email', 'email', array(
                'label' => 'Email',
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
            'data_class' => 'EasymedBundle\Entity\Company',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'company';
    }
}
