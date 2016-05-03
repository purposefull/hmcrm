<?php

namespace AppBundle\Form;

use AppBundle\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

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
            ->add('type', 'choice', [
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
}
