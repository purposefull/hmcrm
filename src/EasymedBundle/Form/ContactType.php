<?php

namespace EasymedBundle\Form;

use EasymedBundle\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * ContactType class.
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
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
                'class' => 'EasymedBundle:Person',
                'choice_label' => 'title',
                'label' => 'person.title',
            ])
            ->add('company', 'entity', [
                'class' => 'EasymedBundle:Company',
                'choice_label' => 'name',
                'label' => 'company.title',
            ]);
    }
}
