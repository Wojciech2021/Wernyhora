<?php

namespace App\Service;

use App\Entity\ProfilValue;

class TheresholdService
{

    public function calculateQ(ProfilValue $profilValue)
    {
        return $profilValue->getCritery()->getAlfaQ() * $profilValue->getValue() + $profilValue->getCritery()->getBetaQ();
    }

    public function calculateP(ProfilValue $profilValue)
    {
        return $profilValue->getCritery()->getAlfaP() * $profilValue->getValue() + $profilValue->getCritery()->getBetaP();
    }

    public function calculateV(ProfilValue $profilValue)
    {
        return $profilValue->getCritery()->getAlfaV() * $profilValue->getValue() + $profilValue->getCritery()->getBetaV();
    }

    public function calculateQTheresgold(ProfilValue $profilValue)
    {

        return [
            'minusQ' => $profilValue->getValue() - $this->calculateQ($profilValue) * $profilValue->getCritery()->getCostGain(),
            'plusQ' => $profilValue->getValue() + $this->calculateQ($profilValue) * $profilValue->getCritery()->getCostGain()
        ];
    }

    public function calculatePTheresgold(ProfilValue $profilValue)
    {

        return [
            'minusP' => $profilValue->getValue() - $this->calculateP($profilValue) * $profilValue->getCritery()->getCostGain(),
            'plusP' => $profilValue->getValue() + $this->calculateP($profilValue) * $profilValue->getCritery()->getCostGain()

        ];
    }

    public function calculateVTheresgold(ProfilValue $profilValue)
    {

        return [
            'minusV' => $profilValue->getValue() - $this->calculateV($profilValue) * $profilValue->getCritery()->getCostGain(),
            'plusV' => $profilValue->getValue() + $this->calculateV($profilValue) * $profilValue->getCritery()->getCostGain()
        ];
    }
}