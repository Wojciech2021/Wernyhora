<?php

namespace App\Service;

use App\Entity\ComputerLog;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\ClassDiscriminatorFromClassMetadata;
use Symfony\Component\Serializer\Mapping\ClassDiscriminatorMapping;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ComputerLogService
{
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getComputerData(int $dateFrom, int $dateTo, string $macAddress)
    {



//        $response = $this->httpClient->request('POST', 'http://192.168.1.12:8080/get/computer/data', [
//            // defining data using an array of parameters
//            'json' => ['dataFrom' => 1653330280, 'dataTo' => 1653330345, 'macAddress' => '902E16B76F7A'],
//            ]);

        $response = $this->httpClient->request('POST', 'http://10.128.128.24:8080/get/computer/data', [
            // defining data using an array of parameters
            'json' => ['dataFrom' => $dateFrom, 'dataTo' => $dateTo, 'macAddress' => $macAddress],
        ]);



        $statusCode = $response->getStatusCode();

        $content = $response->toArray();

        //dd($content);

        return $content;
    }

    public function getJsonData()
    {
        $datas = file_get_contents('dane.json');
        $data = json_decode($datas, true);
        if ($data['success'])
        {
            //dd($data['content']['items']);
            return $data['content'];
        }
        //$data = array_reverse($data);






    }

}