<?php

namespace App\Service;

use App\Entity\ProfilValue;

class TheresholdService
{

    public function calculateQTheresgold(ProfilValue $profilValue)
    {

        return [
            'minusQ' => $profilValue->getValue() - ($profilValue->getCritery()->getAlfaQ() * $profilValue->getValue() + $profilValue->getCritery()->getBetaQ()),
            'plusQ' => $profilValue->getValue() + ($profilValue->getCritery()->getAlfaQ() * $profilValue->getValue() + $profilValue->getCritery()->getBetaQ())
        ];
    }

    public function calculatePTheresgold(ProfilValue $profilValue)
    {

        return [
            'minusP' => $profilValue->getValue() - ($profilValue->getCritery()->getAlfaP() * $profilValue->getValue() + $profilValue->getCritery()->getBetaP()),
            'plusP' => $profilValue->getValue() + ($profilValue->getCritery()->getAlfaP() * $profilValue->getValue() + $profilValue->getCritery()->getBetaP())

        ];
    }

    public function calculateVTheresgold(ProfilValue $profilValue)
    {

        return [
            'minusV' => $profilValue->getValue() - ($profilValue->getCritery()->getAlfaV() * $profilValue->getValue() + $profilValue->getCritery()->getBetaV()),
            'plusV' => $profilValue->getValue() + ($profilValue->getCritery()->getAlfaV() * $profilValue->getValue() + $profilValue->getCritery()->getBetaV())
        ];
    }
}