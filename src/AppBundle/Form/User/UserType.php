<?php

namespace AppBundle\Form\User;

use AppBundle\Entity\User\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, ['label' => 'new_user.label.firstname'])
            ->add('lastName', TextType::class, ['label' => 'new_user.label.lastname'])
            ->add('username', TextType::class, ['label' => 'new_user.label.username'])
            ->add('email', EmailType::class, ['label' => 'new_user.label.email'])
            ->add('mobile', TextType::class,
                [
                    'label' => 'new_user.label.mobile', 'required' => false
                ])
            ->add('submit', SubmitType::class,
                [
                    'label' => 'new_user.label.submit',
                    'attr' =>
                        [
                            'class' => 'btn custom-btn mtop20 pull-right'
                        ]
                ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => User::class,
                'label' => false,
                'validation_groups' => array('NoPasswordRegistration', 'Default'),
                'translation_domain' => 'form'
            ]);
    }

    public function getName()
    {
        return 'new_user';
    }
}

