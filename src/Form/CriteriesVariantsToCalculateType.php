<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CriteriesVariantsToCalculateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $criteries = null;
        $variants = null;

        if ($options['data']) {

            $criteries = $options['data']->getCritery();
            $variants = $options['data']->getVariant();
        }

        $builder
            ->add('criteriesCollection', ChoiceType::class, [
                'label' => 'Kryteria brane pod udział w obliczeniach',
                'choices'  => $criteries,
                'choice_label' => function ($critery){
                    return $critery->getName().':';
                },
                'choice_attr' => function ($critery){
                    return ['checked' => true];
                },
                'multiple' => true,
                'expanded' => true,
                'mapped' => false,
            ])

            ->add('variantsCollection', ChoiceType::class, [
                'label' => 'Warianty brane pod udział w odliczeniach',
                'label_attr' => [
                    'class' => 'text-nowrap'
                ],
                'choices'  => $variants,
                'choice_label' => function ($variant){
                    return $variant->getName().':';
                },
                'choice_attr' => function ($variant){
                    return ['checked' => true];
                },
                'multiple' => true,
                'expanded' => true,
                'mapped' => false,
            ])

            ->add('getRaport', SubmitType::class,[
                'label' => 'Generój raport',
                'attr' => [
                    'class' => 'btn btn-secondary',
                    'style' => 'width: 209px;',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}