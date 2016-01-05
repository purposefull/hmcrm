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
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('customerStatus', 'choice', array(
                'choices' => Company::valuesOfCustomerStatus()
            ))
            ->add('prospectStatus', 'choice', array(
                'choices' => Company::valuesOfProspectStatus()
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

        $builder->setRequired(false);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EasymedBundle\Entity\Company'
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
