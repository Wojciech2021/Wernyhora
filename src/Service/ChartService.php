<?php

namespace App\Service;

class ChartService
{

    public function prepareChart($chart,
                                 $criteries,
                                 $profiles)
    {
        $datasets = [];
        $labels = [];

        foreach ($profiles as $key => $profil)
        {

            $arrayOfElements = [];

            foreach ($profil->getProfilValue() as $profilValue)
            {
                array_push($arrayOfElements, $profilValue->getValue());
            }

            array_push($labels, 'Profil '.$key+1);

            $datasets[] = [
                'label' => 'Profil '.$key+1,
                'borderColor' => 'rgb(0, 0, 192)',
                'data' => $arrayOfElements,
                'borderWidth' => 1.5,
                'tension' => 0.1,
                'fill' => false,
                'pointRadius' => 0,
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