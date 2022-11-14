<?php

namespace App\Form;

use App\Entity\KlasName;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KlasNameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => false,
            ])

            ->add('removeKlasName', ButtonType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'js-klas-name-remove btn-close'
                ]
            ])

//            ->add('Project')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => KlasName::class,
        ]);
    }
}
