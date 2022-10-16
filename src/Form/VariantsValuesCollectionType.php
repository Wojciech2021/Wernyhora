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
        $variantsValues = new ArrayCollection();
        $variantsValues->add(new VariantValue());

        $builder

            ->add('variantsValues', CollectionType::class,
                [
                    'entry_type' => VariantValueFormType::class,
                    'data' => $variantsValues,
                    'allow_add' => true,
                    'allow_delete' => true,
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