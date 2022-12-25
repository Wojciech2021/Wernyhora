<?php

namespace App\Form;

use App\Entity\Critery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CriteryFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder

            ->add('name', null, [
                'label' => false,
                'attr' => [
                    'class' => 'mb-1'
                ],
            ])

            ->add('costGain', ChoiceType::class,[
                'label' => false,
                'choices' => [
                    'Zysk' => 1,
                    'Koszt' => -1,
                ],
                'attr' => [
                    'class' => 'mb-1',
                ],
            ])

            ->add('unit', null, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'class' => 'mb-1'
                ],
            ])

            ->add('weight', null, [
                'label' => false,
                'attr' => [
                    'class' => 'mb-1'
                ],
            ])

            ->add('removeCritery', ButtonType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'js-criterry-remove btn-close'
                ]
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
