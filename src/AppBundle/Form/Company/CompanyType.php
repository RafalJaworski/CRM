<?php

namespace AppBundle\Form\Company;

use AppBundle\Entity\Company\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'new_company.label.name'])
            ->add('dbaName', TextType::class, ['label' => 'new_company.label.dba_name'])
            ->add('description', TextType::class, ['label' => 'new_company.label.description'])
            ->add('address1', TextType::class, ['label' => 'new_company.label.address'])
            ->add('address2', TextType::class, ['label' => 'new_company.label.address2'])
            ->add('telephone', TextType::class, ['pattern' => '\d+', 'label' => 'new_company.label.telephone'])
            ->add('zip', TextType::class, ['label' => 'new_company.label.zip'])
            ->add('city', TextType::class, ['label' => 'new_company.label.city'])
            ->add('country', TextType::class, ['label' => 'new_company.label.country'])
            ->add('VATnumber', TextType::class, ['label' => 'new_company.label.vat'])
            ->add('note', TextareaType::class, ['label' => 'new_company.label.note', 'attr' => ['rows' => 5], 'required' => false])
            ->add('submit', SubmitType::class,
                [
                    'label' => 'new_company.label.submit',
                    'attr' =>
                        [
                            'class' => 'btn custom-btn pull-right'
                        ]
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Company::class,
                'translation_domain' => 'form'
            ]);
    }
}

