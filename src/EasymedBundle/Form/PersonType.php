<?php

namespace EasymedBundle\Form;

use EasymedBundle\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * PersonType class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class PersonType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', 'text', [
                'label' => 'firstname',
            ])
            ->add('lastName', 'text', [
                'label' => 'lastName',
            ])
            ->add('companyName', 'text', [
                'label' => 'company.title',
            ])
            ->add('title', 'text', [
                'label' => 'title',
            ])
            ->add('customerStatus', 'choice', [
                'choices' => Person::valuesOfCustomerStatus(),
                'label'   => 'customerstatus',
            ])
            ->add('prospectStatus', 'choice', [
                'choices' => Person::valuesOfProspectStatus(),
                'label'   => 'prospectstatus',
            ])
            ->add('email', 'text', [
                'label' => 'email',
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
            'data_class' => 'EasymedBundle\Entity\Person',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'person';
    }
}
