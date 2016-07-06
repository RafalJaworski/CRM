<?php

namespace AppBundle\Form\Ticket;

use AppBundle\Entity\Company\Company;
use AppBundle\Entity\Ticket\Ticket;
use AppBundle\Entity\User\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

class TicketType extends AbstractType
{
    private $authorization;
    private $router;

    public function __construct(AuthorizationChecker $authorizationChecker, Router $router)
    {
        $this->authorization = $authorizationChecker;
        $this->router = $router;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class, ['attr' => ['rows' => 5]])
            ->add('priority', ChoiceType::class,
                [
                    'choices' =>
                        [
                            0 => Ticket::PRIORITY_LOW,
                            1 => Ticket::PRIORITY_MEDIUM,
                            2 => Ticket::PRIORITY_HIGH
                        ],
                    'data' => 1
                ]);
            if($this->authorization->isGranted(User::ROLE_ANYMAC_USER)){
                $builder->add('companies',EntityType::class,
                    [

                        'class' => Company::class,
                        'required' =>false,
                        'property' => 'name',
                        'mapped' =>false,
                        'query_builder' => function (EntityRepository $repository){
                            $repository->createQueryBuilder('c');
                        },
                        'attr' => ['data-ajax-users' => $this->router->generate('company_users')],
                    ])

                    ->add('users',EntityType::class,
                        [
                            'required' =>false,
                            'class' =>User::class,
                            'mapped' =>false,
                            'property' => 'username',
                            'query_builder' => function (EntityRepository $repository){
                                $repository->createQueryBuilder('u');
                            },
                            'attr' => ['disabled'=> true]
                        ]);
            }

        $builder
            ->add('submit', SubmitType::class,
                [
                    'label' => 'new_ticket.label.submit',
                    'attr' =>
                        [
                            'class' => 'btn custom-btn pull-right'
                        ]
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Ticket::class, 'translation_domain' => 'form']);
    }
}

