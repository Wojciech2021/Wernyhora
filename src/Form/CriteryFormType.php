<?php

namespace App\Form;

use App\Entity\Critery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CriteryFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('name')

            ->add('unit')

            ->add('weight')

            ->add('removeCritery', ButtonType::class, [
                'label' => '- usuń kryterium',
                'attr' => [
                    'class' => 'js-criterry-remove'
                ]
            ])
            //->add('Project')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Critery::class,
        ]);
    }
}
