<?php

namespace App\Form;

use App\Entity\VariantValue;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VariantsValuesCollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        if ($options['data']->isEmpty())
        {
            $variantsValues = new ArrayCollection([11=>new VariantValue()]);
        }
        else
        {
            $variantsValues = new ArrayCollection();

            foreach ($options['data']->toArray() as $variant)
            {

                foreach ($variant->getVariantValue()->toArray() as $variantValue)
                {
                    $variantsValues->add($variantValue);
                }
            }
        }

        $builder

            ->add('variantsValues', CollectionType::class,
                [
                    'entry_type' => VariantValueFormType::class,
                    'data' => $variantsValues->toArray(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'mapped' => false,
                ]
            )

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}