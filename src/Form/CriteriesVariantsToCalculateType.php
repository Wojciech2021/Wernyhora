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
        $criteriesCollection = null;
        $variantsCollection = null;

        if ($options['data']['project']) {

            $criteries = $options['data']['project']->getCritery();
            $variants = $options['data']['project']->getVariant();
        }

        if (count($options['data']['criteriesCollection']) >= 1)
        {
            $criteriesCollection = $options['data']['criteriesCollection'];
        }

        if (count($options['data']['variantsCollection']) >= 1)
        {
            $variantsCollection = $options['data']['variantsCollection'];
        }
        
        $builder
            ->add('criteriesCollection', ChoiceType::class, [
                'label' => 'Kryteria brane pod udział w obliczeniach',
                'choices'  => $criteries,
                'choice_label' => function ($critery){
                    return $critery->getName().':';
                },
                'choice_attr' => function ($critery) use ($criteriesCollection){
                    if ($criteriesCollection && count($criteriesCollection) >= 1)
                    {
                        foreach ($criteriesCollection as $item)
                        {
                            if ($item->getId() === $critery->getId())
                            {
                                return ['checked' => true];
                            }
                        }
                        return ['checked' => false];
                    }
                    else
                    {
                        return ['checked' => true];
                    }
                },
                'multiple' => true,
                'expanded' => true,
                'mapped' => false,
                'required' => true,
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
                'choice_attr' => function ($variant) use ($variantsCollection){
                    if ($variantsCollection && count($variantsCollection) >= 1)
                    {
                        foreach ($variantsCollection as $item)
                        {
                            if ($item->getId() === $variant->getId())
                            {
                                return ['checked' => true];
                            }
                        }
                        return ['checked' => false];
                    }
                    else
                    {
                        return ['checked' => true];
                    }
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