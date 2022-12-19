<?php

namespace App\Form\Project;

use App\Entity\Project;
use App\Form\CireriesCollectionType;
use App\Form\VariantsCollectionType;
use App\Form\VariantsValuesCollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder

            ->add('name',TextType::class,[
                'label' => 'Nazwa:',

            ])

            ->add('description', TextareaType::class,[
                'label' => 'Opis:'
            ])

            ->add('cutOffLevel', NumberType::class,[
                'label' => 'Poziom odcięcia:'
            ])

            ->add('saveProject', SubmitType::class,[
                'label' => 'Zapisz',
                'attr' => [
                    'class' => 'btn btn-secondary',
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
