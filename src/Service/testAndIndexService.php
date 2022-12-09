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
                    $this->calculateValueCompatibilityTest();

                }
            }
        }
    }

    private function calculateValueCompatibilityTest(cdsigmaTestValue $cdsigmaTestValue)
    {
        $abConformanceconformanceTestValue = 0;
        $baConformanceconformanceTestValue = 0;

        if (!$cdsigmaTestValue->getVariantValue() <= ($cdsigmaTestValue->getProfilValue() - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())))
        {
            if (!$cdsigmaTestValue->getVariantValue() >= ($cdsigmaTestValue->getProfilValue() - $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue())))
            {
                $abConformanceconformanceTestValue = ($this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()) - $cdsigmaTestValue->getProfilValue() + $cdsigmaTestValue->getVariantValue())
                /($this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()) - $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue()));
            }
            else
            {
                $abConformanceconformanceTestValue = 1;
            }
        }

        if (!$cdsigmaTestValue->getProfilValue() <= ($cdsigmaTestValue->getVariantValue() - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())))
        {
            if (!$cdsigmaTestValue->getProfilValue() >= ($cdsigmaTestValue->getVariantValue() - $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue())))
            {
                $baConformanceconformanceTestValue = ($this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()) - $cdsigmaTestValue->getVariantValue() + $cdsigmaTestValue->getProfilValue())
                    /($this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()) - $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue()));
            }
            else
            {
                $baConformanceconformanceTestValue = 1;
            }
        }

        $cdsigmaTestValue->setAbConformanceconformanceTestValue($abConformanceconformanceTestValue);
        $cdsigmaTestValue->setBaConformanceconformanceTestValue($baConformanceconformanceTestValue);
    }


}
