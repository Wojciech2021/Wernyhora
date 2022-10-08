<?php

namespace App\Service;

class ChartService
{

    public function prepareChart(bool $cpu, bool $ram, bool $freq, bool $gpu, $chart, array $arrayOfElements)
    {
        $datasets = [];
        if ($cpu)
        {
            $datasets[] = [
                'label' => 'CPU',
                'backgroundColor' => 'rgb(0, 0, 192)',
                'borderColor' => 'rgb(0, 0, 192)',
                'data' => $arrayOfElements['cpu'],
                'borderWidth' => 1.5,
                'tension' => 0.1,
                'fill' => false,
                'pointRadius' => 0,
            ];
        }

        if ($ram)
        {
            $datasets[] = [
                'label' => 'RAM',
                'backgroundColor' => 'rgb(192, 0, 0)',
                'borderColor' => 'rgb(192, 0, 0)',
                'data' => $arrayOfElements['ram'],
                'borderWidth' => 1.5,
                'tension' => 0.1,
                'fill' => false,
                'pointRadius' => 0,
            ];
        }

        if ($freq)
        {
            $datasets[] = [
                'label' => 'FREQ',
                'backgroundColor' => 'rgb(0, 192, 0)',
                'borderColor' => 'rgb(0, 192, 0)',
                'data' => $arrayOfElements['freq'],
                'borderWidth' => 1.5,
                'tension' => 0.1,
                'fill' => false,
                'pointRadius' => 0,
            ];
        }

        if ($gpu)
        {
            $datasets[] = [
                'label' => 'GPU',
                'backgroundColor' => 'rgb(75, 192, 192)',
                'borderColor' => 'rgb(75, 192, 192)',
                'data' => $arrayOfElements['gpu'],
                'borderWidth' => 1.5,
                'tension' => 0.1,
                'fill' => false,
                'pointRadius' => 0,
            ];
        }

        $chart->setData([
            'labels' => $arrayOfElements['date'],
            'datasets' => $datasets
        ]);


        return $chart;
    }
}