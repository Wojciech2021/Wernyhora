<?php

namespace App\Form;

use App\Entity\ProfilValue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilValueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('value',null, [
                    'label' => false,
                    'required' => true,
            ])
//            ->add('Critery')
//            ->add('Profil')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProfilValue::class,
        ]);
    }
}
