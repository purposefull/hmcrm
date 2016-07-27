<?php

namespace AppBundle\Form;

use AppBundle\Entity\Deal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * DealType class.
 *
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
            ->add('name', TextType::class, [
                'label' => 'name',
            ])
            ->add('contact', 'entity', [
                'class' => 'AppBundle:Contact',
                'choice_label' => 'name',
                'label' => 'contact.title',
            ])
            ->add('stage', ChoiceType::class, [
                'choices' => Deal::valuesOfStage(),
                'label' => 'stage',
            ])
            ->add('value', TextType::class, [
                'label' => 'value',
            ])
            ->add('currency', TextType::class, [
                'label' => 'currency',
            ])
            ->add('source', TextType::class, [
                'label' => 'source',
            ])
            ->add('tags', TextType::class, [
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
            'data_class' => 'AppBundle\Entity\Deal',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'AppBundle_deal';
    }
}
