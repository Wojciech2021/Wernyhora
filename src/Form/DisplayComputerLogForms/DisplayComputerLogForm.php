<?php

namespace App\Form\DisplayComputerLogForms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class DisplayComputerLogForm extends AbstractType
{

    private $today;

    public function __construct()
    {
        $this->today = new \DateTime();
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_from', DateType::class, [
                'label' => 'Od:',
                'widget' => 'single_text',
                'mapped' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('date_to', DateType::class, [
                'label' => 'Do:',
                'widget' => 'single_text',
                'mapped' => false,
                'required' => true,
                'data' => $this->today,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('cpu', CheckboxType::class, [
                'label' => 'CPU: ',
                'mapped' => false,
                'required' => false,
            ])
            ->add('ram', CheckboxType::class, [
                'label' => 'RAM: ',
                'mapped' => false,
                'required' => false,
            ])
            ->add('freq', CheckboxType::class, [
                'label' => 'FREQ: ',
                'mapped' => false,
                'required' => false,
            ])
            ->add('gpu', CheckboxType::class, [
                'label' => 'GPU: ',
                'mapped' => false,
                'required' => false,
            ])
            ->add('display', SubmitType::class, [
                'label' => 'Wyświetl',
                'attr' => [
                    'class' => 'btn btn-secondary'
                ]
            ]);
    }
}