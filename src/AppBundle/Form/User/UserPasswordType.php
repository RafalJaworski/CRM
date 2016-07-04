<?php

namespace AppBundle\Form\User;

use AppBundle\Entity\User\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('plain_password', RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'invalid_message' => 'new_password.error',
                    'required' => true,
                    'error_bubbling' => false,

                    'first_options' =>
                        [
                            'label' => 'new_password.label.password',
                            'translation_domain' => 'form'
                        ],

                    'second_options' =>
                        [
                            'label' => 'new_password.label.re-password',
                            'translation_domain' => 'form'
                        ],
                ])
            ->add('submit', SubmitType::class,
                [
                    'label' => 'new_password.label.submit',
                    'attr' => ['class' => 'btn custom-btn pull-right']
                ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => User::class,
                'label' => false,
                'validation_groups' => array('ChangePassword', 'Default'),
                'translation_domain' => 'form'
            ]);
    }

    public function getName()
    {
        return 'new_password';
    }

}