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
            ->add('name', 'text', array(
                'label' => 'name'
            ))
            ->add('contact', 'entity', array(
                'class' => 'EasymedBundle:Contact',
                'choice_label' => 'name',
                'label' => 'contact.title'
            ))
            ->add('stage', 'choice', array(
                'choices' => Deal::valuesOfStage(),
                'label' => 'stage'
            ))
            ->add('value', 'text', array(
                'label' => 'value'
            ))
            ->add('currency', 'text', array(
                'label' => 'currency'
            ))
            ->add('source', 'text', array(
                'label' => 'source'
            ))
            ->add('tags', 'text', array(
                'label' => 'tags'
            ))
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
