<?php

namespace App\Form;

use App\Entity\Critery;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CireriesCollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $criteries = new ArrayCollection();
        $criteries->add(new Critery());

        $builder

            ->add('criteries', CollectionType::class,
                [
                    'entry_type' => CriteryFormType::class,
                    'data' => $criteries,
                    'allow_add' => true,
                    'allow_delete' => true,
                ]
            )

            ->add('addCritery', ButtonType::class, [
                'label' => '+ dodaj kryterium',
                'attr' => [
                    'class' => 'js-criterry-add'
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
