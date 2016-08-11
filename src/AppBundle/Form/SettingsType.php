<?php

namespace AppBundle\Form;

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
 * SettingsType class.
 *
 */
class SettingsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('emailService', ChoiceType::class, [
                'choices' => [
                    'MailerLite' => 'mailerlite',
                    'GetResponse' => 'getresponse',
                    'MailChimp' => 'mailchimp',
                    'Aweber' => 'aweber'
                ],
//                'label' => 'firstname',
            ])
            ->add('taskService', ChoiceType::class, [
                'choices' => [
                    'WunderList' => 'wunderlist',
                    'Todoist' => 'todoist',
                    'MailChimp' => 'mailchimp',
                    'Trello' => 'trello',
                    'Asana' => 'asana'
                ],
//                'label' => 'lead.status',
            ])
            ->add('emailApiKey', TextType::class, [
                'label' => 'Email API key',
            ])
            ->add('taskApiKey', TextType::class, [
                'label' => 'Task API key',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit',
            ])
        ;

//        $builder->setRequired(false);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\User',
            'csrf_protection' => false,
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'settings';
    }
}
