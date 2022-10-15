<?php

namespace App\Form;

use App\Entity\Variant;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VariantsCollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $variants = new ArrayCollection();
        $variants->add(new Variant());

        $builder

            ->add('variants', CollectionType::class,
                [
                    'entry_type' => VariantFormType::class,
                    'data' => $variants,
                    'allow_add' => true,
                    'allow_delete' => true,
                ]
            )

            ->add('addVariant', ButtonType::class, [
                'label' => '+ dodaj wariant',
                'attr' => [
                    'class' => 'js-variant-add'
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
