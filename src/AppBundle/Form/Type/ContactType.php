<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * ContactType class.
 */
class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('submit', 'submit', [
                'label' => 'add',
            ])
            ->add('type', ChoiceType::class, [
                'choices' => Contact::valueOfContactType(),
                'label' => 'Type',
            ])
            ->add('person', 'entity', [
                'class' => 'AppBundle:Person',
                'choice_label' => 'title',
                'label' => 'person.title',
            ])
            ->add('company', 'entity', [
                'class' => 'AppBundle:Company',
                'choice_label' => 'name',
                'label' => 'company.title',
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
