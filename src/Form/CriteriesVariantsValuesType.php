<?php

namespace App\Form;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


//use App\Entity\VariantValue;
//use App\Form\CriteryFormType;
//use App\Form\VariantFormType;
use App\Form\CireriesCollectionType;
use App\Form\VariantsCollectionType;

class CriteriesVariantsValuesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {


        //$variantsValues = new ArrayCollection();



        //$variantsValues->add(new VariantValue());


        $builder

            ->add('criteriesCollection', CireriesCollectionType::class,
                [
                    'label' => ' ',
                ])

            ->add('variantsCollection', VariantsCollectionType::class,
                [
                    'label' => ' ',
                ])

            ->add('variantsValuesCollection', VariantsValuesCollectionType::class,
                [
                    'label' => ' ',
                ])

            ->add('addValues', SubmitType::class,[
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
