<?php

namespace App\Service;

use App\Service\TheresholdService;

class ChartService
{

    private function randomColor()
    {
        return 'rgb('.rand(0,255).','.rand(0,255).','.rand(0,255).')';
    }

    public function prepareChart($chart,
                                 $profiles,
                                TheresholdService $theresholdService,
                                                    $criteriesOnChart,
                                                    $thresholdOnChart)
    {
//        dd($profiles);

        $chart->setOptions([
            'plugins' => [
                'autocolors',
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'x' => [
                    'ticks' => [
                        'autoSkip' => false,
                        'maxRotation' => 90,
                        'minRotation' => 90,
                    ]
                ],
                'y' => [
                    'ticks' => [
                        'autoSkip' => false,
                        'maxRotation' => 90,
                        'minRotation' => 90,
                    ]
                ]
            ]
        ]);

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
            $data = [];

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

            $color = $this->randomColor();

//            dd($arrayOfProfil);

            $datasets[] = [
                'label' => 'Profil '.$key+1,
                'data' =>  $arrayOfProfil,
                ];

            if (in_array('q', $thresholdOnChart))
            {
                $datasets[] = [
                    'label' => 'Profil '.($key+1).' - q'.($key+1),
                    'data' =>  $arrayOfMinusQ,
//                'fill' => '-1'
                ];

                $datasets[] = [
                    'label' => 'Profil '.($key+1).' + q'.($key+1),
                    'data' =>  $arrayOfPlusQ,
//                'fill' => '-2'
                ];
            }

            if (in_array('p', $thresholdOnChart))
            {
                $datasets[] = [
                    'label' => 'Profil '.($key+1).' - p'.($key+1),
                    'data' =>  $arrayOfMinusP,
//                'fill' => '-3'
                ];

                $datasets[] = [
                    'label' => 'Profil '.($key+1).' + p'.($key+1),
                    'data' =>  $arrayOfPlusP,
//                'fill' => '-4'
                ];
            }

            if (in_array('v', $thresholdOnChart))
            {
                $datasets[] = [
                    'label' => 'Profil '.($key+1).' - v'.($key+1),
                    'data' =>  $arrayOfMinusV,
//                'fill' => '-5'
                ];

                $datasets[] = [
                    'label' => 'Profil '.($key+1).' + v'.($key+1),
                    'data' =>  $arrayOfPlusV,
//                'fill' => '-6'
                ];
            }

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


        $chart->setData([
            'labels' => $labels,
            'datasets' => $datasets
        ]);


        return $chart;
    }
}