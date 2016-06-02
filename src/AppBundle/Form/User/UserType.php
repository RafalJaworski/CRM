<?php

namespace AppBundle\Form\User;

use AppBundle\Entity\User\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName',TextType::class)
            ->add('lastName',TextType::class)
            ->add('username', TextType::class)
            ->add('email',EmailType::class)
            ->add('plain_password',PasswordType::class)
            ->add('mobile',TextType::class,['required'=>false,'pattern' => '\d+']);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class'=>User::class,
                'label'=>false,
                'validation_groups' =>  array('CreateUser', 'Default')
            ]);
    }

    public function getName()
    {
        return 'new_user';
    }
}

