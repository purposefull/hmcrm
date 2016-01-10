<?php

namespace EasymedBundle\Form;

use EasymedBundle\Entity\Deal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DealType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('contact', 'entity', array(
                'class' => 'EasymedBundle:Contact',
                'choice_label' => 'name',
            ))
            ->add('stage', 'choice', array(
                'choices' => Deal::valuesOfStage()
            ))
            ->add('value')
            ->add('currency')
            ->add('source')
            ->add('tags')
        ;

        $builder->setRequired(false);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EasymedBundle\Entity\Deal'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'easymedbundle_deal';
    }
}
