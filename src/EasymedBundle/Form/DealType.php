<?php

namespace EasymedBundle\Form;

use EasymedBundle\Entity\Deal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * DealType class.
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class DealType extends AbstractType
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
            ->add('contact', 'entity', [
                'class' => 'EasymedBundle:Contact',
                'choice_label' => 'name',
                'label' => 'contact.title',
            ])
            ->add('stage', 'choice', [
                'choices' => Deal::valuesOfStage(),
                'label' => 'stage',
            ])
            ->add('value', 'text', [
                'label' => 'value',
            ])
            ->add('currency', 'text', [
                'label' => 'currency',
            ])
            ->add('source', 'text', [
                'label' => 'source',
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
            'data_class' => 'EasymedBundle\Entity\Deal',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'easymedbundle_deal';
    }
}
