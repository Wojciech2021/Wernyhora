<?php

namespace App\Form;

use App\Entity\Variant;
use App\Entity\VariantValue;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VariantsCollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        if ($options['data']->getVariant()->isEmpty())
        {
            $variants = new ArrayCollection();
            $variants->add(new Variant());
        }
        else
        {
            $variants = $options['data']->getVariant();
        }

        $builder

            ->add('variants', CollectionType::class,
                [
                    'entry_type' => VariantFormType::class,
                    'data' => $variants,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'mapped' => false,
                ]
            )

            ->add('addVariant', ButtonType::class, [
                'label' => '+ dodaj wariant',
                'attr' => [
                    'class' => 'js-variant-add btn btn-primary',
                    'style' => 'width: 209px;',
                ]
            ])

            ->add('saveVariants', SubmitType::class,[
                'label' => 'Zapisz',
                'attr' => [
                    'class' => 'btn btn-primary',
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
