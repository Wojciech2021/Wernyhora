<?php

namespace App\Form\Project;

use App\Entity\Project;
use App\Form\CireriesCollectionType;
use App\Form\VariantsCollectionType;
use App\Form\VariantsValuesCollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder

            ->add('name',TextType::class,[
                'label' => 'Nazwa:',

            ])

            ->add('description', TextareaType::class,[
                'label' => 'Opis:'
            ])

            ->add('criteriesCollection', CireriesCollectionType::class,
                [
                    'label' => ' ',
                    'mapped' => false,
                    'data' => $options['data']->getCritery(),
                ])

            ->add('variantsCollection', VariantsCollectionType::class,
                [
                    'label' => ' ',
                    'mapped' => false,
                    'data' => $options['data']->getVariant(),
                ])
//
//            ->add('variantsValuesCollection', VariantsValuesCollectionType::class,
//                [
//                    'label' => ' ',
//                    'mapped' => false,
////                    'data' => [
////                        'variants' => $options['data']->getVariant(),
////                        'citeries' =>  $options['data']->getCritery(),
////                        ],
//                    'data' => $options['data']->getVariant(),
//                ])

            ->add('addProject', SubmitType::class,[
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
            'data_class' => Project::class,
        ]);
    }
}
