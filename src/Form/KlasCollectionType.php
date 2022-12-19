<?php

namespace App\Form;

use App\Entity\Klas;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KlasCollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        if ($options['data']->getKlas()->isEmpty())
        {
            $klasNames = new ArrayCollection();
            $klasNames->add(new Klas());
        }
        else
        {
            $klasNames = $options['data']->getKlas();
        }

        $builder
            ->add('klas', CollectionType::class,
                [
                    'entry_type' => KlasType::class,
                    'data' => $klasNames,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'mapped' => false,
                ])

            ->add('addKlas', ButtonType::class, [
                'label' => '+ dodaj klasę',
                'attr' => [
                    'class' => 'js-klas-add btn btn-secondary',
                    'style' => 'width: 209px;',
                ]
            ])

            ->add('saveKlas', SubmitType::class,[
                'label' => 'Zapisz',
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
