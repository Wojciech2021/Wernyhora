<?php

namespace App\Service;

use App\Service\Model\cdsigmaTestValue;
use Doctrine\Common\Collections\ArrayCollection;

class PatrialTestValuesService
{
   private $criteries;
    private $testIndex;
   private $theresholdService;

   public function __construct($criteries, TheresholdService $theresholdService)
   {
       $this->criteries = $criteries;
       $this->theresholdService = $theresholdService;
       $this->testIndex = new ArrayCollection();
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
        foreach ($this->criteries as $critery)
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
        if ($cdsigmaTestValue->getVariantValue()->getCritery()->getCostGain() == 1)
        {
            if($cdsigmaTestValue->getVariantValue()->getValue()
                + $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue())
                >= $cdsigmaTestValue->getProfilValue()->getValue())
            {
                $abConformanceconformanceTestValue = 1;
            }
            else
            {
                if ($cdsigmaTestValue->getVariantValue()->getValue()
                    + $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
                    > $cdsigmaTestValue->getProfilValue()->getValue())
                {
                    $abConformanceconformanceTestValue =
                        (($cdsigmaTestValue->getVariantValue()->getValue()
                                + $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()))
                            - $cdsigmaTestValue->getProfilValue()->getValue())
                        /($this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
                            - $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue()));
                }
                else
                {
                    $abConformanceconformanceTestValue = 0;
                }
            }

            if ($cdsigmaTestValue->getProfilValue()->getValue()
                + $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue())
                >= $cdsigmaTestValue->getVariantValue()->getValue())
            {
                $baConformanceconformanceTestValue = 1;
            }
            else
            {
                if ($cdsigmaTestValue->getProfilValue()->getValue()
                    + $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
                    > $cdsigmaTestValue->getVariantValue()->getValue())
                {
                    $baConformanceconformanceTestValue = (($cdsigmaTestValue->getProfilValue()->getValue()
                                + $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()))
                            - $cdsigmaTestValue->getVariantValue()->getValue())
                        /($this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
                            - $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue()));
                }
                else
                {
                    $baConformanceconformanceTestValue = 0;
                }
            }
        }
        else
        {
            if ($cdsigmaTestValue->getVariantValue()->getValue()
                - $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue())
                <=  $cdsigmaTestValue->getProfilValue()->getValue())
            {
                $abConformanceconformanceTestValue = 1;
            }
            else
            {
                if ($cdsigmaTestValue->getVariantValue()->getValue()
                    - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
                    < $cdsigmaTestValue->getProfilValue()->getValue())
                {
                    $abConformanceconformanceTestValue = ($cdsigmaTestValue->getProfilValue()->getValue()
                            - ($cdsigmaTestValue->getVariantValue()->getValue()
                                - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())))
                        /($this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
                            - $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue()));
                }
                else
                {
                    $abConformanceconformanceTestValue = 0;
                }
            }

            if ($cdsigmaTestValue->getProfilValue()->getValue()
                - $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue())
                <= $cdsigmaTestValue->getVariantValue()->getValue())
            {
                $baConformanceconformanceTestValue = 1;
            }
            else
            {
                if ($cdsigmaTestValue->getProfilValue()->getValue()
                    - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
                    < $cdsigmaTestValue->getVariantValue()->getValue())
                {
                    $baConformanceconformanceTestValue = ($cdsigmaTestValue->getVariantValue()->getValue()
                            - ($cdsigmaTestValue->getProfilValue()->getValue()
                                - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())))
                        /($this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
                            - $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue()));
                }
                else
                {
                    $baConformanceconformanceTestValue = 0;
                }
            }
        }

        $cdsigmaTestValue->setAbConformanceTestValue($abConformanceconformanceTestValue);
        $cdsigmaTestValue->setBaConformanceTestValue($baConformanceconformanceTestValue);
    }

    private function calculateValueNonCompatibilityTest(cdsigmaTestValue $cdsigmaTestValue)
    {
        if ($cdsigmaTestValue->getVariantValue()->getCritery()->getCostGain() == 1)
        {
            if ($cdsigmaTestValue->getVariantValue()->getValue()
                + $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
                >= $cdsigmaTestValue->getProfilValue()->getValue())
            {
                $abNonconformanceconformanceTestValue = 0;
            }
            else
            {
                if ($cdsigmaTestValue->getVariantValue()->getValue()
                    + $this->theresholdService->calculateV($cdsigmaTestValue->getProfilValue())
                    > $cdsigmaTestValue->getProfilValue()->getValue())
                {
                    $abNonconformanceconformanceTestValue = ($cdsigmaTestValue->getProfilValue()->getValue()
                            - ($cdsigmaTestValue->getVariantValue()->getValue()
                                + $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())))
                        /($this->theresholdService->calculateV($cdsigmaTestValue->getProfilValue())
                            - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()));
                }
                else
                {
                    $abNonconformanceconformanceTestValue = 1;
                }
            }

            if ($cdsigmaTestValue->getProfilValue()->getValue()
                + $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
                >= $cdsigmaTestValue->getVariantValue()->getValue())
            {
                $baNonconformanceconformanceTestValue = 0;
            }
            else
            {
                if ($cdsigmaTestValue->getProfilValue()->getValue()
                    + $this->theresholdService->calculateV($cdsigmaTestValue->getProfilValue())
                    > $cdsigmaTestValue->getVariantValue()->getValue())
                {
                    $baNonconformanceconformanceTestValue = ($cdsigmaTestValue->getVariantValue()->getValue()
                            - ($cdsigmaTestValue->getProfilValue()->getValue()
                                + $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())))
                        /($this->theresholdService->calculateV($cdsigmaTestValue->getProfilValue())
                            - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()));
                }
                else
                {
                    $baNonconformanceconformanceTestValue = 1;
                }
            }
        }
        else
        {
            if ($cdsigmaTestValue->getVariantValue()->getValue()
                - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
                <= $cdsigmaTestValue->getProfilValue()->getValue())
            {
                $abNonconformanceconformanceTestValue = 0;
            }
            else
            {
                if ($cdsigmaTestValue->getVariantValue()->getValue()
                    - $this->theresholdService->calculateV($cdsigmaTestValue->getProfilValue())
                    < $cdsigmaTestValue->getProfilValue()->getValue())
                {
                    $abNonconformanceconformanceTestValue = (($cdsigmaTestValue->getVariantValue()->getValue()
                                - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()))
                            - $cdsigmaTestValue->getProfilValue()->getValue())
                        /($this->theresholdService->calculateV($cdsigmaTestValue->getProfilValue())
                            - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()));
                }
                else
                {
                    $abNonconformanceconformanceTestValue = 1;
                }
            }

            if ($cdsigmaTestValue->getProfilValue()->getValue()
                - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
                <= $cdsigmaTestValue->getVariantValue()->getValue())
            {
                $baNonconformanceconformanceTestValue = 0;
            }
            else
            {
                if ($cdsigmaTestValue->getProfilValue()->getValue()
                    - $this->theresholdService->calculateV($cdsigmaTestValue->getProfilValue())
                    < $cdsigmaTestValue->getVariantValue()->getValue())
                {
                    $baNonconformanceconformanceTestValue = (($cdsigmaTestValue->getProfilValue()->getValue()
                                - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()))
                            - $cdsigmaTestValue->getVariantValue()->getValue())
                        /($this->theresholdService->calculateV($cdsigmaTestValue->getProfilValue())
                            - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()));
                }
                else
                {
                    $baNonconformanceconformanceTestValue = 1;
                }
            }
        }

        $cdsigmaTestValue->setAbNonconformanceTestValue($abNonconformanceconformanceTestValue);
        $cdsigmaTestValue->setBaNonconformanceTestValue($baNonconformanceconformanceTestValue);
    }

    private function calculateWeighedAverageFromCdSigma(cdsigmaTestValue $cdsigmaTestValue)
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
        $weighedAverage = $this->calculateWeighedAverageFromCdSigma($cdsigmaTestValue);

        if ($cdsigmaTestValue->getAbNonconformanceTestValue() > $weighedAverage['weighedAverageA'])
        {
            if (1 - $weighedAverage['weighedAverageA'] == 0)
            {
                $abCredibilityIndex = 0;
            }
            else
            {
                $abCredibilityIndex = (1 - $cdsigmaTestValue->getAbNonconformanceTestValue())
                    / (1 - $weighedAverage['weighedAverageA']);
            }
        }
        else
        {
            $abCredibilityIndex = 1;
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
            $baCredibilityIndex = 1;
        }

        $cdsigmaTestValue->setAbCredibilityIndex($abCredibilityIndex);
        $cdsigmaTestValue->setBaCredibilityIndex($baCredibilityIndex);
    }
}