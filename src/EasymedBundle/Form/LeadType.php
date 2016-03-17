<?php

namespace EasymedBundle\Form;

use EasymedBundle\Entity\Lead;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * LeadType class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class LeadType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('submit', 'submit', [
                'label' => 'name',
            ])
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
            ->add('leadStatus', 'choice', [
                'choices' => Lead::valuesOfStatus(),
                'label'   => 'lead.status',
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
            'data_class' => 'EasymedBundle\Entity\Lead',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lead';
    }
}
