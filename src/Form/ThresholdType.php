<?php

namespace App\Form;

use App\Entity\Critery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ThresholdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
//            ->add('name')
//            ->add('unit')
//            ->add('weight')
            ->add('alfaQ',null, [
                'label' => false,
                'required' => true,
            ])

            ->add('betaQ',null, [
                'label' => false,
                'required' => true,
            ])

            ->add('alfaP',null, [
                'label' => false,
                'required' => true,
            ])

            ->add('betaP',null, [
                'label' => false,
                'required' => true,
            ])

            ->add('alfaV',null, [
                'label' => false,
                'required' => true,
            ])

            ->add('betaV',null, [
                'label' => false,
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Critery::class,
        ]);
    }
}
