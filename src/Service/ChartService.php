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
//        dd($profiles);
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
//            $data = [];

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

//            dd($labels, $data, array_keys($arrayOfElements));
//            dd($arrayOfElements);

//            dd($arrayOfElements);

//            $color = $this->randomColor();

//            dd($arrayOfProfil);

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
//                'fill' => '-1'
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
//                'fill' => '-3'
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
//                'fill' => '-2'
                ];

                $datasets[] = [
                    'label' => 'Profil '.($key+1).' + v'.($key+1),
                    'backgroundColor' => 'rgba('.$profil->getColorRV().','.$profil->getColorGV().','.$profil->getColorBV().',0.5)',
                    'borderColor' => 'rgba('.$profil->getColorRV().','.$profil->getColorGV().','.$profil->getColorBV().',0.5)',
                    'data' =>  $arrayOfPlusV,
                'fill' => '-1'
                ];
            }

//            dd($datasets);

        }

//        if ($cpu)
//        {
//            $datasets[] = [
//                'label' => 'CPU',
//                'backgroundColor' => 'rgb(0, 0, 192)',
//                'borderColor' => 'rgb(0, 0, 192)',
//                'data' => $arrayOfElements['cpu'],
//                'borderWidth' => 1.5,
//                'tension' => 0.1,
//                'fill' => false,
//                'pointRadius' => 0,
//            ];
//        }

        $datasToMinMax = [];

        foreach ($datasets as $dataset)
        {
            foreach ($dataset['data'] as $data)
            {
                $datasToMinMax[] = $data;
            }
        }

        $min = min($datasToMinMax);
        $min = intval($min - $min/10);

        $max = max($datasToMinMax);
        $max = intval($max + $max/10);

        $chart->setOptions([
            'plugins' => [
//                'autocolors',
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
//                'x' => [
//                    'ticks' => [
//                        'autoSkip' => false,
//                        'maxRotation' => 90,
//                        'minRotation' => 90,
//                    ]
//                ],
                'y' => [
                    'min' => $min,
                    'max' => $max,
                ]
            ]
        ]);

//        dd($datasToMinMax, $min, $max);

        $chart->setData([
            'labels' => $labels,
            'datasets' => $datasets
        ]);


        return $chart;
    }
}