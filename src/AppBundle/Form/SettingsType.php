<?php

namespace AppBundle\Form;

use AppBundle\Entity\Lead;
use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * SettingsType class.
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

//            ->add('taskService', ChoiceType::class, [
//                'choices' => [
//                    'WunderList' => 'wunderlist',
//                    'Todoist' => 'todoist',
//                    'Asana' => 'asana',
//                    'Trello' => 'trello',
//                ],
////                'label' => 'lead.status',
//            ])
//            ->add('taskApiKey', TextType::class, [
//                'label' => 'Task API key',
//            ])

//            ->add('emailServiceAuto', ChoiceType::class, [
//                'choices' => [
//                    'MailerLite' => 'mailerlite',
//                    'GetResponse' => 'getresponse',
//                    'MailChimp' => 'mailchimp',
//                    'Aweber' => 'aweber',
//                    'ConstantContact' => 'constantcontact',
//                ],
////                'label' => 'firstname',
//            ])
//            ->add('emailApiKey', TextType::class, [
//                'label' => 'Email API key',
//            ])

            ->add('emailServer', TextType::class, [
                'label' => 'Email server: ',
            ])
            ->add('emailLogin', TextType::class, [
                'label' => 'Email login: ',
            ])
            ->add('emailPassword', TextType::class, [
                'label' => 'Email password: ',
            ])

            //https://github.com/SimpleSoftwareIO/simple-sms
//            ->add('smsService', ChoiceType::class, [
//                'choices' => [
//                    'Plivo' => 'plivo',
//                    'Clickatell' => 'clickatell',
//                    'Twilio' => 'twilio',
//                    'Nexmo' => 'nexmo',
//                    'Tropo' => 'tropo',
//                    'SMSRU' => 'smsru',
//                    'TurboSMS' => 'turbosms',
//                ],
////                'label' => 'lead.status',
//            ])
//            ->add('smsApiKey', TextType::class, [
//                'label' => 'SMS API key',
//            ])

//            ->add('submit', SubmitType::class, [
//                'label' => 'Submit',
//            ])
        ;

//        $builder->setRequired(false);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection' => false,
        ]);
    }
}
