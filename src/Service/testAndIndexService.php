<?php

namespace App\Service;

use App\Entity\Project;
use App\Service\Model\cdsigmaTestValue;
use Doctrine\Common\Collections\ArrayCollection;

class testAndIndexService
{

    private $project;
    private $testIndex;
    private $theresholdService;

    public function __construct(Project $project, TheresholdService $theresholdService)
    {
        $this->project = $project;
        $this->testIndex = new ArrayCollection();
        $this->theresholdService = $theresholdService;
    }

    /**
     * @return ArrayCollection
     */
    public function getTestIndex(): ArrayCollection
    {
        $this->makeCompatibilityTest();
        $this->calculateCredibilityIndex();
        return $this->testIndex;
    }

    /**
     * @param ArrayCollection $testIndex
     */
    public function setTestIndex(ArrayCollection $testIndex): void
    {
        $this->testIndex = $testIndex;
    }

    private function makeCompatibilityTest()
    {
        foreach ($this->project->getCritery() as $critery)
        {
            foreach ($critery->getVariantValue() as $variantValue)
            {
                foreach ($critery->getProfilValue() as $profilValue)
                {
                    $cdSigmaTestValue = new cdsigmaTestValue($variantValue, $profilValue);
                    $this->calculateValueCompatibilityTest($cdSigmaTestValue);
                    $this->calculateValueNonCompatibilityTest($cdSigmaTestValue);
                    $this->testIndex->add($cdSigmaTestValue);
                }
            }
        }
    }

    private function calculateCredibilityIndex()
    {
        foreach ($this->testIndex as $cdSigmaTestValue)
        {
            $this->calculateCredibilityIndexValue($cdSigmaTestValue);
        }
    }

    private function calculateValueCompatibilityTest(cdsigmaTestValue $cdsigmaTestValue)
    {

        if ($cdsigmaTestValue->getVariantValue()->getValue() <= ($cdsigmaTestValue->getProfilValue()->getValue() - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())))
        {
            $abConformanceconformanceTestValue = 0;

        }
        elseif ($cdsigmaTestValue->getVariantValue()->getValue() >= ($cdsigmaTestValue->getProfilValue()->getValue() - $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue())))
        {
            $abConformanceconformanceTestValue = 1;
        }
        else
        {
            $abConformanceconformanceTestValue = ($this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()) - $cdsigmaTestValue->getProfilValue()->getValue() + $cdsigmaTestValue->getVariantValue()->getValue())
                /($this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()) - $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue()));
        }

        if ($cdsigmaTestValue->getProfilValue()->getValue() <= ($cdsigmaTestValue->getVariantValue()->getValue() - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())))
        {
            $baConformanceconformanceTestValue = 0;
        }
        elseif ($cdsigmaTestValue->getProfilValue()->getValue() >= ($cdsigmaTestValue->getVariantValue()->getValue() - $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue())))
        {
            $baConformanceconformanceTestValue = 1;
        }
        else
        {
            $baConformanceconformanceTestValue = ($this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()) - $cdsigmaTestValue->getVariantValue()->getValue() + $cdsigmaTestValue->getProfilValue()->getValue())
                /($this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()) - $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue()));
        }

        if ($cdsigmaTestValue->getVariantValue()->getCritery()->getCostGain() == 1)
        {
            $cdsigmaTestValue->setAbConformanceTestValue($abConformanceconformanceTestValue);
            $cdsigmaTestValue->setBaConformanceTestValue($baConformanceconformanceTestValue);
        }
        else
        {
            $cdsigmaTestValue->setAbConformanceTestValue($baConformanceconformanceTestValue);
            $cdsigmaTestValue->setBaConformanceTestValue($abConformanceconformanceTestValue);
        }


    }

    private function calculateValueNonCompatibilityTest(cdsigmaTestValue $cdsigmaTestValue)
    {
        if ($cdsigmaTestValue->getVariantValue()->getValue() >= ($cdsigmaTestValue->getProfilValue()->getValue() - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())))
        {
            $abNonconformanceconformanceTestValue = 0;

        }
        elseif ($cdsigmaTestValue->getVariantValue()->getValue() <= ($cdsigmaTestValue->getProfilValue()->getValue() - $this->theresholdService->calculateV($cdsigmaTestValue->getProfilValue())))
        {
            $abNonconformanceconformanceTestValue = 1;
        }
        else
        {
            $abNonconformanceconformanceTestValue = ($cdsigmaTestValue->getProfilValue()->getValue() - $cdsigmaTestValue->getVariantValue()->getValue() + $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()))
                /($this->theresholdService->calculateV($cdsigmaTestValue->getProfilValue()) - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()));
        }

        if ($cdsigmaTestValue->getProfilValue()->getValue() >= ($cdsigmaTestValue->getVariantValue()->getValue() - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())))
        {
            $baNonconformanceconformanceTestValue = 0;
        }
        elseif ($cdsigmaTestValue->getProfilValue()->getValue() <= ($cdsigmaTestValue->getVariantValue()->getValue() - $this->theresholdService->calculateV($cdsigmaTestValue->getProfilValue())))
        {
            $baNonconformanceconformanceTestValue = 1;
        }
        else
        {
            $baNonconformanceconformanceTestValue = ($cdsigmaTestValue->getVariantValue()->getValue() - $cdsigmaTestValue->getProfilValue()->getValue() + $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()))
                /($this->theresholdService->calculateV($cdsigmaTestValue->getProfilValue()) - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()));
        }

        $cdsigmaTestValue->setAbNonconformanceTestValue($abNonconformanceconformanceTestValue);
        $cdsigmaTestValue->setBaNonconformanceTestValue($baNonconformanceconformanceTestValue);
    }

    private function calculateWeighedAverage(cdsigmaTestValue $cdsigmaTestValue)
    {
        $weighedAverageA = 0;
        $weighedAverageB = 0;
        $sumWeight = 0;

        $filteredTestIndex = $this->testIndex->filter(function ($element) use ($cdsigmaTestValue) {
            return $element->getVariantValue()->getVariant() == $cdsigmaTestValue->getVariantValue()->getVariant()
                && $element->getProfilValue()->getProfil() == $cdsigmaTestValue->getProfilValue()->getProfil();
        });

        foreach ($filteredTestIndex as $cdsigmaTestValue)
        {
            $weighedAverageA +=  $cdsigmaTestValue->getAbConformanceTestValue()
                * $cdsigmaTestValue->getVariantValue()->getCritery()->getWeight();

            $weighedAverageB += $cdsigmaTestValue->getBaConformanceTestValue()
                * $cdsigmaTestValue->getProfilValue()->getCritery()->getWeight();

            $sumWeight += $cdsigmaTestValue->getVariantValue()->getCritery()->getWeight();
        }

        $weighedAverageA = $weighedAverageA / $sumWeight;
        $weighedAverageB = $weighedAverageB / $sumWeight;

        return [
            'weighedAverageA' => $weighedAverageA,
            'weighedAverageB' => $weighedAverageB
        ];
    }

    private function calculateCredibilityIndexValue(cdsigmaTestValue $cdsigmaTestValue)
    {
        $weighedAverage = $this->calculateWeighedAverage($cdsigmaTestValue);

        if ($cdsigmaTestValue->getAbNonconformanceTestValue() > $weighedAverage['weighedAverageA'])
        {
            $abCredibilityIndex = 0;

            if (1 - $weighedAverage['weighedAverageA'] != 0)
            {
                $abCredibilityIndex = (1 - $cdsigmaTestValue->getAbNonconformanceTestValue())
                    / (1 - $weighedAverage['weighedAverageA']);
            }
        }
        else
        {
            $abCredibilityIndex = 'X';
        }

        if ($cdsigmaTestValue->getBaNonconformanceTestValue() > $weighedAverage['weighedAverageB'])
        {
            $baCredibilityIndex = 0;

            if (1 - $weighedAverage['weighedAverageB'] != 0)
            {
                $baCredibilityIndex = (1 - $cdsigmaTestValue->getBaNonconformanceTestValue())
                    / (1 - $weighedAverage['weighedAverageB']);
            }
        }
        else
        {
            $baCredibilityIndex = 'X';
        }

        $cdsigmaTestValue->setAbCredibilityIndex($abCredibilityIndex);
        $cdsigmaTestValue->setBaCredibilityIndex($baCredibilityIndex);
    }


}
