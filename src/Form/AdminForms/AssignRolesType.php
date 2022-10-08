<?php

namespace App\Form\AdminForms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssignRolesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('roles', ChoiceType::class, [
                'label' => 'Role:',
                'choices' => [
                    'Dyrektor' => 'ROLE_MANAGER',
                    'Kierownik' => 'ROLE_SUPERVISOR',
                    'Pracownik' => 'ROLE_WORKER',
                    'Administrator' => 'ROLE_ADMIN'
                ],
                'attr' =>
                [
                    'class' => 'form-select'
                ],
                'required' => true,
                'placeholder' => '',
            ])
            ->add('save_role', SubmitType::class, [
                'label' => 'Przydziel',
                'attr' => [
                    'class' => 'btn btn-secondary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
