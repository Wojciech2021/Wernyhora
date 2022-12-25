<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ThresholdCollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $criteries = null;

        if (!$options['data']->isEmpty())
        {
            $criteries = $options['data'];
        }

        $builder
            ->add('threshold', CollectionType::class,
                [
                    'entry_type' => ThresholdType::class,
                    'data' => $criteries,
                    'mapped' => false,
                ]
            )

            ->add('criteriesCollection', ChoiceType::class, [
                'label' => 'Kryteria wyświetlane na wykresie',
                'choices'  => $criteries,
                'choice_label' => function ($critery){
                    return $critery->getName().':';
                },
                'multiple' => true,
                'expanded' => true,
                'mapped' => false,
            ])

            ->add('thresholdTypes', ChoiceType::class, [
                'label' => 'Progi wyświetlane na wykresie',
                'choices'  => [
                    'Nierozróżnialności:' => 'q',
                    'Preferencji:' => 'p',
                    'Weta:' => 'v'
                ],
                'multiple' => true,
                'expanded' => true,
                'mapped' => false,
            ])

            ->add('addThreshold', SubmitType::class,[
                'label' => 'Zapisz',
                'attr' => [
                    'class' => 'btn btn-primary',
                    'style' => 'width: 209px;',
                ]
            ])

            ->add('raport', SubmitType::class,[
                'label' => 'Raport',
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
            // Configure your form options here
        ]);
    }
}
