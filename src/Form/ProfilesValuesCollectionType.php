<?php

namespace App\Form;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilesValuesCollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $profilesValues = new ArrayCollection();

        foreach ($options['data']->getProfil() as $profil)
        {

            foreach ($profil->getProfilValue() as $profilValue)
            {
                $profilesValues->add($profilValue);
            }
        }

        $builder

            ->add('profilesValues', CollectionType::class,
                [
                    'entry_type' => ProfilValueType::class,
                    'data' => $profilesValues,
//                    'allow_add' => true,
//                    'allow_delete' => true,
                    'mapped' => false,
                ]
            )

            ->add('addProfilesValues', SubmitType::class,[
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
