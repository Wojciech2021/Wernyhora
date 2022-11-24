<?php

namespace App\Service;

class ChartService
{

    private function randomColor()
    {
        return 'rgb('.rand(0,255).','.rand(0,255).','.rand(0,255).')';
    }

    public function prepareChart($chart,
                                 $criteries,
                                 $profiles)
    {
        $chart->setOptions([
            'plugins' => [
                'autocolors'
            ]
        ]);
//        dd($chart);
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
                $arrayOfProfil += [$profilValue->getCritery()->getName() => $profilValue->getValue()];

                $arrayOfMinusQ += [$profilValue->getCritery()->getName() => $profilValue->getValue() - ($profilValue->getCritery()->getAlfaQ() * $profilValue->getValue() + $profilValue->getCritery()->getBetaQ())];
                $arrayOfPlusQ += [$profilValue->getCritery()->getName() => $profilValue->getValue() + ($profilValue->getCritery()->getAlfaQ() * $profilValue->getValue() + $profilValue->getCritery()->getBetaQ())];

                $arrayOfMinusP += [$profilValue->getCritery()->getName() => $profilValue->getValue() - ($profilValue->getCritery()->getAlfaP() * $profilValue->getValue() + $profilValue->getCritery()->getBetaP())];
                $arrayOfPlusP += [$profilValue->getCritery()->getName() => $profilValue->getValue() + ($profilValue->getCritery()->getAlfaP() * $profilValue->getValue() + $profilValue->getCritery()->getBetaP())];

                $arrayOfMinusV += [$profilValue->getCritery()->getName() => $profilValue->getValue() - ($profilValue->getCritery()->getAlfaV() * $profilValue->getValue() + $profilValue->getCritery()->getBetaV())];
                $arrayOfPlusV += [$profilValue->getCritery()->getName() => $profilValue->getValue() + ($profilValue->getCritery()->getAlfaV() * $profilValue->getValue() + $profilValue->getCritery()->getBetaV())];
            }

//            dd($labels, $data, array_keys($arrayOfElements));
//            dd($arrayOfElements);

//            dd($arrayOfElements);

            $color = $this->randomColor();

//            dd($color);

            $datasets[] = [
                'label' => 'Profil '.$key+1,
                'data' =>  $arrayOfProfil,
                ];

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