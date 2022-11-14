<?php

namespace App\Form;

use App\Entity\VariantValue;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VariantsValuesCollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $variantsValues = new ArrayCollection();

        foreach ($options['data']->getVariant() as $variant)
        {

            foreach ($variant->getVariantValue() as $variantValue)
            {
                $variantsValues->add($variantValue);
            }
        }

        $builder

            ->add('variantsValues', CollectionType::class,
                [
                    'entry_type' => VariantValueFormType::class,
                    'data' => $variantsValues,
//                    'allow_add' => true,
//                    'allow_delete' => true,
                    'mapped' => false,
                ]
            )

            ->add('addVariantsValues', SubmitType::class,[
                'label' => 'Zapisz wartości',
                'attr' => [
                    'class' => 'btn btn-secondary'
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