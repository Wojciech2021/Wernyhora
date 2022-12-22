<?php

namespace App\Service;

use App\Service\TheresholdService;

class ChartService
{

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
                    if (count($criteriesOnChart) == 1)
                    {
                        $arrayOfProfil += ['.'
                        => $profilValue->getValue()];

                        $arrayOfMinusQ += ['.'
                        => $theresholdService->calculateQTheresgold($profilValue)['minusQ']];
                        $arrayOfPlusQ += ['.'
                        => $theresholdService->calculateQTheresgold($profilValue)['plusQ']];

                        $arrayOfMinusP += ['.'
                        => $theresholdService->calculatePTheresgold($profilValue)['minusP']];
                        $arrayOfPlusP += ['.'
                        => $theresholdService->calculatePTheresgold($profilValue)['plusP']];

                        $arrayOfMinusV += ['.'
                        => $theresholdService->calculateVTheresgold($profilValue)['minusV']];
                        $arrayOfPlusV += ['.'
                        => $theresholdService->calculateVTheresgold($profilValue)['plusV']];
                    }

                    $arrayOfProfil += [$profilValue->getCritery()->getName().' ['.$profilValue->getCritery()->getUnit().']'
                    => $profilValue->getValue()];

                    $arrayOfMinusQ += [$profilValue->getCritery()->getName().' ['.$profilValue->getCritery()->getUnit().']'
                    => $theresholdService->calculateQTheresgold($profilValue)['minusQ']];
                    $arrayOfPlusQ += [$profilValue->getCritery()->getName().' ['.$profilValue->getCritery()->getUnit().']'
                    => $theresholdService->calculateQTheresgold($profilValue)['plusQ']];

                    $arrayOfMinusP += [$profilValue->getCritery()->getName().' ['.$profilValue->getCritery()->getUnit().']'
                    => $theresholdService->calculatePTheresgold($profilValue)['minusP']];
                    $arrayOfPlusP += [$profilValue->getCritery()->getName().' ['.$profilValue->getCritery()->getUnit().']'
                    => $theresholdService->calculatePTheresgold($profilValue)['plusP']];

                    $arrayOfMinusV += [$profilValue->getCritery()->getName().' ['.$profilValue->getCritery()->getUnit().']'
                    => $theresholdService->calculateVTheresgold($profilValue)['minusV']];
                    $arrayOfPlusV += [$profilValue->getCritery()->getName().' ['.$profilValue->getCritery()->getUnit().']'
                    => $theresholdService->calculateVTheresgold($profilValue)['plusV']];

                    if (count($criteriesOnChart) == 1)
                    {
                        $arrayOfProfil += [','
                        => $profilValue->getValue()];

                        $arrayOfMinusQ += [','
                        => $theresholdService->calculateQTheresgold($profilValue)['minusQ']];
                        $arrayOfPlusQ += [','
                        => $theresholdService->calculateQTheresgold($profilValue)['plusQ']];

                        $arrayOfMinusP += [','
                        => $theresholdService->calculatePTheresgold($profilValue)['minusP']];
                        $arrayOfPlusP += [','
                        => $theresholdService->calculatePTheresgold($profilValue)['plusP']];

                        $arrayOfMinusV += [','
                        => $theresholdService->calculateVTheresgold($profilValue)['minusV']];
                        $arrayOfPlusV += [','
                        => $theresholdService->calculateVTheresgold($profilValue)['plusV']];
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
                        => $profilValue->getValue()];
                    }

                    $arrayOfProfil += [$profilValue->getCritery()->getName().' ['.$profilValue->getCritery()->getUnit().']'
                    => $profilValue->getValue()];


                    if (count($criteriesOnChart) == 1)
                    {
                        $arrayOfProfil += [','
                        => $profilValue->getValue()];
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
                        => $variantValue->getValue()];
                    }

                    $arrayOfVariant += [$variantValue->getCritery()->getName().' ['.$variantValue->getCritery()->getUnit().']'
                    => $variantValue->getValue()];


                    if (count($criteriesOnChart) == 1)
                    {
                        $arrayOfVariant += [','
                        => $variantValue->getValue()];
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