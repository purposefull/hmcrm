<?php

namespace EasymedBundle\Form;

use EasymedBundle\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * CompanyType class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class CompanyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', [
                'label' => 'name',
            ])
            ->add('customerStatus', 'choice', [
                'choices' => Company::valuesOfCustomerStatus(),
                'label'   => 'customerstatus',
            ])
            ->add('prospectStatus', 'choice', [
        'choices' => Company::valuesOfProspectStatus(),
        'label'   => 'prospectstatus',
    ])
        ->add('email', 'email', [
            'label' => 'Email',
        ])
        ->add('mobilePhone', 'text', [
            'label' => 'mobilephone',
        ])
        ->add('workPhone', 'text', [
            'label' => 'workphone',
        ])
        ->add('address', 'text', [
            'label' => 'address',
        ])
        ->add('city', 'text', [
            'label' => 'city',
        ])
        ->add('zipCode', 'text', [
            'label' => 'zipcode',
        ])
        ->add('region', 'text', [
            'label' => 'region',
        ])
        ->add('country', 'text', [
            'label' => 'country',
        ])
        ->add('tags', 'text', [
            'label' => 'tags',
        ]);

        $builder->setRequired(false);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'EasymedBundle\Entity\Company',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'company';
    }
}
