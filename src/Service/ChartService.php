<?php

namespace App\Service;

use App\Entity\Critery;
use App\Entity\ProfilValue;
use App\Entity\VariantValue;
use App\Service\TheresholdService;

class ChartService
{

    private function dataNormalisationVariant(VariantValue $variantValue)
    {
        return (($variantValue->getValue() *100)/ $this->sumValues($variantValue->getCritery()));
    }

    private function dataNormalisationProfil(ProfilValue $profilValue)
    {
        return (($profilValue->getValue() *100)/ $this->sumValues($profilValue->getCritery()));
    }

    private function dataNormalisationProfilTheresgold(ProfilValue $profilValue, TheresholdService $theresholdService)
    {
        return [
            'profil' => (($profilValue->getValue() *100)/ $this->sumValues($profilValue->getCritery())),
            'Q' => [
                'minus' => (($theresholdService->calculateQTheresgold($profilValue)['minusQ'] *100)/ $this->sumValues($profilValue->getCritery())),
                'plus' => (($theresholdService->calculateQTheresgold($profilValue)['plusQ'] *100)/ $this->sumValues($profilValue->getCritery())),
            ],
            'P' => [
                'minus' => (($theresholdService->calculatePTheresgold($profilValue)['minusP'] *100)/ $this->sumValues($profilValue->getCritery())),
                'plus' => (($theresholdService->calculatePTheresgold($profilValue)['plusP'] *100)/ $this->sumValues($profilValue->getCritery())),
            ],
            'V' => [
                'minus' => (($theresholdService->calculateVTheresgold($profilValue)['minusV'] *100)/ $this->sumValues($profilValue->getCritery())),
                'plus' => (($theresholdService->calculateVTheresgold($profilValue)['plusV'] *100)/ $this->sumValues($profilValue->getCritery())),
            ],
        ];
    }

    private function sumValues(Critery $critery)
    {
        $sumValues = 0;

        foreach ($critery->getVariantValue() as $variantValue)
        {
            $sumValues += $variantValue->getValue();
        }

        foreach ($critery->getProfilValue() as $profilValue)
        {
            $sumValues += $profilValue->getValue();
        }

        return $sumValues;
    }



    public function prepareChart($chart,
                                 $profiles,
                                TheresholdService $theresholdService,
                                                    $criteriesOnChart,
                                                    $thresholdOnChart)
    {

        $datasets = [];
        $labels = [];

        foreach ($profiles as $key => $profil)
        {

            $arrayOfProfil = [];
            $arrayOfMinusQ = [];
            $arrayOfPlusQ = [];
            $arrayOfMinusP = [];
            $arrayOfPlusP = [];
            $arrayOfMinusV = [];
            $arrayOfPlusV = [];
            $labels = [];

            foreach ($profil->getProfilValue() as $profilValue)
            {
                if (in_array($profilValue->getCritery(), $criteriesOnChart))
                {
                    $dataNormalisationProfilTheresgold = $this->dataNormalisationProfilTheresgold($profilValue, $theresholdService);

                    if (count($criteriesOnChart) == 1)
                    {
                        $arrayOfProfil += ['.'
                        => $dataNormalisationProfilTheresgold['profil']];

                        $arrayOfMinusQ += ['.'
                        => $dataNormalisationProfilTheresgold['Q']['minus']];
                        $arrayOfPlusQ += ['.'
                        => $dataNormalisationProfilTheresgold['Q']['plus']];

                        $arrayOfMinusP += ['.'
                        => $dataNormalisationProfilTheresgold['P']['minus']];
                        $arrayOfPlusP += ['.'
                        => $dataNormalisationProfilTheresgold['P']['plus']];

                        $arrayOfMinusV += ['.'
                        => $dataNormalisationProfilTheresgold['V']['minus']];
                        $arrayOfPlusV += ['.'
                        => $dataNormalisationProfilTheresgold['V']['plus']];
                    }

                    $arrayOfProfil += [$profilValue->getCritery()->getName().' ['.$profilValue->getCritery()->getUnit().']'
                    => $dataNormalisationProfilTheresgold['profil']];

                    $arrayOfMinusQ += [$profilValue->getCritery()->getName().' ['.$profilValue->getCritery()->getUnit().']'
                    => $dataNormalisationProfilTheresgold['Q']['minus']];
                    $arrayOfPlusQ += [$profilValue->getCritery()->getName().' ['.$profilValue->getCritery()->getUnit().']'
                    => $dataNormalisationProfilTheresgold['Q']['plus']];

                    $arrayOfMinusP += [$profilValue->getCritery()->getName().' ['.$profilValue->getCritery()->getUnit().']'
                    => $dataNormalisationProfilTheresgold['P']['minus']];
                    $arrayOfPlusP += [$profilValue->getCritery()->getName().' ['.$profilValue->getCritery()->getUnit().']'
                    => $dataNormalisationProfilTheresgold['P']['plus']];

                    $arrayOfMinusV += [$profilValue->getCritery()->getName().' ['.$profilValue->getCritery()->getUnit().']'
                    => $dataNormalisationProfilTheresgold['V']['minus']];
                    $arrayOfPlusV += [$profilValue->getCritery()->getName().' ['.$profilValue->getCritery()->getUnit().']'
                    => $dataNormalisationProfilTheresgold['V']['plus']];

                    if (count($criteriesOnChart) == 1)
                    {
                        $arrayOfProfil += [','
                        => $dataNormalisationProfilTheresgold['profil']];

                        $arrayOfMinusQ += [','
                        => $dataNormalisationProfilTheresgold['Q']['minus']];
                        $arrayOfPlusQ += [','
                        => $dataNormalisationProfilTheresgold['Q']['plus']];

                        $arrayOfMinusP += [','
                        => $dataNormalisationProfilTheresgold['P']['minus']];
                        $arrayOfPlusP += [','
                        => $dataNormalisationProfilTheresgold['P']['plus']];

                        $arrayOfMinusV += [','
                        => $dataNormalisationProfilTheresgold['V']['minus']];
                        $arrayOfPlusV += [','
                        => $dataNormalisationProfilTheresgold['V']['plus']];
                    }
                }
            }

            $datasets[] = [
                'label' => 'Profil '.$key+1,
                'backgroundColor' => 'rgb('.$profil->getColorR().','.$profil->getColorG().','.$profil->getColorB().')',
                'borderColor' => 'rgb('.$profil->getColorR().','.$profil->getColorG().','.$profil->getColorB().')',
                'data' =>  $arrayOfProfil,
                ];

            if (in_array('q', $thresholdOnChart))
            {
                $datasets[] = [
                    'label' => 'Profil '.($key+1).' - q'.($key+1),
                    'backgroundColor' => 'rgba('.$profil->getColorRQ().','.$profil->getColorGQ().','.$profil->getColorBQ().',0.5)',
                    'borderColor' => 'rgba('.$profil->getColorRQ().','.$profil->getColorGQ().','.$profil->getColorBQ().',0.5)',
                    'data' =>  $arrayOfMinusQ,
                ];

                $datasets[] = [
                    'label' => 'Profil '.($key+1).' + q'.($key+1),
                    'backgroundColor' => 'rgba('.$profil->getColorRQ().','.$profil->getColorGQ().','.$profil->getColorBQ().',0.5)',
                    'borderColor' => 'rgba('.$profil->getColorRQ().','.$profil->getColorGQ().','.$profil->getColorBQ().',0.5)',
                    'data' =>  $arrayOfPlusQ,
                'fill' => '-1'
                ];
            }

            if (in_array('p', $thresholdOnChart))
            {
                $datasets[] = [
                    'label' => 'Profil '.($key+1).' - p'.($key+1),
                    'backgroundColor' => 'rgba('.$profil->getColorRP().','.$profil->getColorGP().','.$profil->getColorBP().',0.5)',
                    'borderColor' => 'rgba('.$profil->getColorRP().','.$profil->getColorGP().','.$profil->getColorBP().',0.5)',
                    'data' =>  $arrayOfMinusP,
                ];

                $datasets[] = [
                    'label' => 'Profil '.($key+1).' + p'.($key+1),
                    'backgroundColor' => 'rgba('.$profil->getColorRP().','.$profil->getColorGP().','.$profil->getColorBP().',0.5)',
                    'borderColor' => 'rgba('.$profil->getColorRP().','.$profil->getColorGP().','.$profil->getColorBP().',0.5)',
                    'data' =>  $arrayOfPlusP,
                'fill' => '-1'
                ];
            }

            if (in_array('v', $thresholdOnChart))
            {

                $datasets[] = [
                    'label' => 'Profil '.($key+1).' - v'.($key+1),
                    'backgroundColor' => 'rgba('.$profil->getColorRV().','.$profil->getColorGV().','.$profil->getColorBV().',0.1)',
                    'borderColor' => 'rgba('.$profil->getColorRV().','.$profil->getColorGV().','.$profil->getColorBV().',0.1)',
                    'data' =>  $arrayOfMinusV,
                ];

                $datasets[] = [
                    'label' => 'Profil '.($key+1).' + v'.($key+1),
                    'backgroundColor' => 'rgba('.$profil->getColorRV().','.$profil->getColorGV().','.$profil->getColorBV().',0.5)',
                    'borderColor' => 'rgba('.$profil->getColorRV().','.$profil->getColorGV().','.$profil->getColorBV().',0.5)',
                    'data' =>  $arrayOfPlusV,
                'fill' => '-1'
                ];
            }
        }

        $datasToMinMax = [];

        foreach ($datasets as $dataset)
        {
            foreach ($dataset['data'] as $data)
            {
                $datasToMinMax[] = $data;
            }
        }

        $min = 0;
        $max = 0;

        if ($datasToMinMax)
        {
            $min = min($datasToMinMax);
            $min = round($min - $min/10, 2);

            $max = max($datasToMinMax);
            $max = round($max + $max/30, 2);
        }


        $chart->setOptions([
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'min' => $min,
                    'max' => $max,
                    'display' => false,
                ],
                'x' => [
                    'ticks' => [
                        'autoSkip' => false,
                        'maxRotation' => 90,
                        'minRotation' => 90,
                    ]
                ],
            ]
        ]);

        $chart->setData([
            'labels' => $labels,
            'datasets' => $datasets
        ]);


        return $chart;
    }

    public function prepareChartToRaport($chart,
                                         $profiles,
                                         $variantsOnChart,
                                         $criteriesOnChart)
    {

        $datasets = [];
        $labels = [];

        foreach ($profiles as $key => $profil)
        {

            $arrayOfProfil = [];
            $labels = [];

            foreach ($profil->getProfilValue() as $profilValue)
            {
                if (in_array($profilValue->getCritery(), $criteriesOnChart))
                {

                    if (count($criteriesOnChart) == 1)
                    {
                        $arrayOfProfil += ['.'
                        => $this->dataNormalisationProfil($profilValue)];
                    }

                    $arrayOfProfil += [$profilValue->getCritery()->getName().' ['.$profilValue->getCritery()->getUnit().']'
                    => $this->dataNormalisationProfil($profilValue)];


                    if (count($criteriesOnChart) == 1)
                    {
                        $arrayOfProfil += [','
                        => $this->dataNormalisationProfil($profilValue)];
                    }
                }
            }

            $datasets[] = [
                'label' => 'Profil '.$key+1,
                'backgroundColor' => 'rgb('.$profil->getColorR().','.$profil->getColorG().','.$profil->getColorB().')',
                'borderColor' => 'rgb('.$profil->getColorR().','.$profil->getColorG().','.$profil->getColorB().')',
                'data' =>  $arrayOfProfil,
            ];
        }

        foreach ($variantsOnChart as $key => $variant)
        {

            $arrayOfVariant = [];
            $labels = [];

            foreach ($variant->getVariantValue() as $variantValue)
            {
                if (in_array($variantValue->getCritery(), $criteriesOnChart))
                {

                    if (count($criteriesOnChart) == 1)
                    {
                        $arrayOfVariant += ['.'
                        => $this->dataNormalisationVariant($variantValue)];
                    }

                    $arrayOfVariant += [$variantValue->getCritery()->getName().' ['.$variantValue->getCritery()->getUnit().']'
                    => $this->dataNormalisationVariant($variantValue)];


                    if (count($criteriesOnChart) == 1)
                    {
                        $arrayOfVariant += [','
                        => $this->dataNormalisationVariant($variantValue)];
                    }
                }
            }

            $datasets[] = [
                'label' => $variant->getName(),
                'backgroundColor' => 'rgb('.$variant->getColorR().','.$variant->getColorG().','.$variant->getColorB().')',
                'borderColor' => 'rgb('.$variant->getColorR().','.$variant->getColorG().','.$variant->getColorB().')',
                'data' =>  $arrayOfVariant,
            ];
        }

        $datasToMinMax = [];

        foreach ($datasets as $dataset)
        {
            foreach ($dataset['data'] as $data)
            {
                $datasToMinMax[] = $data;
            }
        }

        $min = 0;
        $max = 0;

        if ($datasToMinMax)
        {
            $min = min($datasToMinMax);
            $min = round($min - $min/10, 2);

            $max = max($datasToMinMax);
            $max = round($max + $max/30, 2);
        }


        $chart->setOptions([
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'min' => $min,
                    'max' => $max,
                    'display' => false,
                ],
                'x' => [
                    'ticks' => [
                        'autoSkip' => false,
                        'maxRotation' => 90,
                        'minRotation' => 90,
                    ]
                ],
            ]
        ]);

        $chart->setData([
            'labels' => $labels,
            'datasets' => $datasets
        ]);

        return $chart;

    }
}