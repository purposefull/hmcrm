<?php

namespace EasymedBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * TransactionType class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class TransactionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('patient', 'entity', [
            'class'    => 'EasymedBundle\Entity\Patient',
            'property' => 'fullName',
        ]);
        $builder->add('status', 'text');
        $builder->add('date', 'date', [
            'input' => 'timestamp',
        ]);
        $builder->add('amount', 'integer');
        $builder->add('submit', 'submit');

        $builder->setRequired(false);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'easymed_doctor';
    }
}
