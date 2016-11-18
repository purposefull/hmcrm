<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Lead;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * LeadType class.
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
            ->add('submit', SubmitType::class, [
                'label' => 'add',
            ])
            ->add('firstName', TextType::class, [
                'label' => 'firstname',
            ])
            ->add('leadStatus', ChoiceType::class, [
                'choices' => Lead::valuesOfStatus(),
                'label' => 'lead.status',
            ])
            ->add('email', EmailType::class, [
                'label' => 'email',
            ])
            ->add('mobilePhone', NumberType::class, [
                'label' => 'mobilephone',
            ])
        ;

        $builder->setRequired(false);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lead::class,
        ]);
    }
}
