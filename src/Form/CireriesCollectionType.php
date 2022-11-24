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

        if ($options['data']->isEmpty())
        {
            $criteries = new ArrayCollection();
            $criteries->add(new Critery());
        }
        else
        {
            $criteries = $options['data'];
        }

        $builder

            ->add('criteries', CollectionType::class,
                [
                    'entry_type' => CriteryFormType::class,
                    'data' => $criteries,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'mapped' => false,
                ]
            )

            ->add('addCritery', ButtonType::class, [
                'label' => '+ dodaj kryterium',
                'attr' => [
                    'class' => 'js-criterry-add btn btn-warning'
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
