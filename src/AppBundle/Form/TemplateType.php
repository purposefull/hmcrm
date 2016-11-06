<?php

namespace AppBundle\Form;

use AppBundle\Entity\Template;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * TemplateType class.
 */
class TemplateType extends AbstractType
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
            ->add('name', TextType::class, [
                'label' => 'name',
            ])
            ->add('code', TextType::class, [
                'label' => 'price',
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
            'data_class' => Template::class,
        ]);
    }
}
