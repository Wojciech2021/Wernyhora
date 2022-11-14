<?php

namespace App\Form;

use App\Entity\KlasName;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KlasNameCollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        if ($options['data']->getKlasName()->isEmpty())
        {
            $klasNames = new ArrayCollection();
            $klasNames->add(new KlasName());
        }
        else
        {
            $klasNames = $options['data']->getKlasName();
        }

        $builder
            ->add('klassNames', CollectionType::class,
                [
                    'entry_type' => KlasNameType::class,
                    'data' => $klasNames,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'mapped' => false,
                ])

            ->add('addKlasName', ButtonType::class, [
                'label' => '+ dodaj klasę',
                'attr' => [
                    'class' => 'js-klas-name-add btn btn-warning'
                ]
            ])

            ->add('addKlasNames', SubmitType::class,[
                'label' => 'Zapisz',
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
