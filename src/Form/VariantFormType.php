<?php

namespace App\Form;

use App\Entity\Variant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VariantFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder

            ->add('name', null, [
                'label' => false,
//                'label' => 'Nazwa: ',
//                'label_attr' => [
//                    'class' => 'pr-2',
//                    'style' => 'padding-right: 5px;'
//                ],
                'attr' => [
                    'class' => 'mb-1'
                ],
            ])

            ->add('removeVariant', ButtonType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'js-variant-remove btn-close'
                ]
            ])
            //->add('Project')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Variant::class,
        ]);
    }
}
