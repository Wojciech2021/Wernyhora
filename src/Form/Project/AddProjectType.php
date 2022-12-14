<?php

namespace App\Form\Project;

use App\Entity\Project;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('name',TextType::class,[
                'label' => 'Nazwa:',

            ])

            ->add('description', TextareaType::class,[
                'label' => 'Opis:',
                'attr' => [
                    'style' => 'width: 209px;',
                ]
            ])

            ->add('addProject', SubmitType::class,[
                'label' => 'Dodaj projekt',
                'attr' => [
                    'class' => 'btn btn-primary',
                    'style' => 'width: 209px;',
                ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
