<?php

namespace App\Service;

use App\Entity\Critery;
use App\Entity\Project;
use App\Service\Model\cdsigmaTestValue;
use App\Service\Model\variantKlas;
use App\Service\Model\variantProfilCredibilityIndexRelation;
use Doctrine\Common\Collections\ArrayCollection;

class testAndIndexService
{

    private $project;
    private $testIndex;
    private $variantsProfilsCredibilityIndexRelation;
    private $variantsKlas;
    private $theresholdService;
    private $patrialTestValuesService;
    private $variantProfilRelationService;
    private $variantsKlasService;
    private $criteries;
    private $variants;
    private $profils;

    public function __construct(Project $project,
                                TheresholdService $theresholdService,
                                $criteries,
                                $variants,
                                $profils)
    {
        $this->project = $project;
        $this->theresholdService = $theresholdService;
        $this->criteries = $criteries;
        $this->variants = $variants;
        $this->profils = $profils;
    }

    public function getTestValues()
    {
        return [
            'testIndex' => $this->getTestIndex(),
            'variantProfilCredibilityIndexRelation' => $this->getVariantProfilCredibilityIndexRelation(),
            'variantsKlas' => $this->getVariantsKlas(),
        ];
    }

    /**
     * @return ArrayCollection
     */
    private function getTestIndex(): ArrayCollection
    {
        $this->patrialTestValuesService = new PatrialTestValuesService($this->criteries, $this->theresholdService);
        $this->testIndex = $this->patrialTestValuesService->getTestIndex();

        return $this->testIndex;
    }

    /**
     * @param ArrayCollection $testIndex
     */
    public function setTestIndex(ArrayCollection $testIndex): void
    {
        $this->testIndex = $testIndex;
    }

    /**
     * @return ArrayCollection
     */
    private function getVariantProfilCredibilityIndexRelation(): ArrayCollection
    {
        $this->variantProfilRelationService = new VariantProfilRelationService($this->variants, $this->profils, $this->testIndex, $this->project);
        $this->variantsProfilsCredibilityIndexRelation = $this->variantProfilRelationService->getVariantProfilCredibilityIndexRelation();
        return $this->variantsProfilsCredibilityIndexRelation;
    }

    /**
     * @param ArrayCollection $variantProfilCredibilityIndexRelationAssignedKlas
     */
    public function setVariantProfilCredibilityIndexRelation(
        ArrayCollection $variantProfilCredibilityIndexRelation): void
    {
        $this->variantProfilCredibilityIndexRelationAssignedKlas = $variantProfilCredibilityIndexRelation;
    }

    /**
     * @return ArrayCollection
     */
    public function getVariantsKlas(): ArrayCollection
    {
        $this->variantsKlasService = new VariantsKlasService($this->variants, $this->variantsProfilsCredibilityIndexRelation, $this->project->getKlas());
        $this->variantsKlas = $this->variantsKlasService->getVariantsKlas();
        return $this->variantsKlas;
    }

    /**
     * @param ArrayCollection $variantKlas
     */
    public function setVariantKlas(ArrayCollection $variantKlas): void
    {
        $this->variantKlas = $variantKlas;
    }

//    private function makeCompatibilityTest()
//    {
//        foreach ($this->project->getCritery() as $critery)
//        {
//            foreach ($critery->getVariantValue() as $variantValue)
//            {
//                foreach ($critery->getProfilValue() as $profilValue)
//                {
//                    $cdSigmaTestValue = new cdsigmaTestValue($variantValue, $profilValue);
//                    $this->calculateValueCompatibilityTest($cdSigmaTestValue);
//                    $this->calculateValueNonCompatibilityTest($cdSigmaTestValue);
//                    $this->testIndex->add($cdSigmaTestValue);
//                }
//            }
//        }
//    }

//    private function calculateCredibilityIndex()
//    {
//        foreach ($this->testIndex as $cdSigmaTestValue)
//        {
//            $this->calculateCredibilityIndexValue($cdSigmaTestValue);
//        }
//    }

//    private function calculateValueCompatibilityTest(cdsigmaTestValue $cdsigmaTestValue)
//    {
//        if ($cdsigmaTestValue->getVariantValue()->getCritery()->getCostGain() == 1)
//        {
//            if($cdsigmaTestValue->getVariantValue()->getValue()
//                + $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue())
//                >= $cdsigmaTestValue->getProfilValue()->getValue())
//            {
//                $abConformanceconformanceTestValue = 1;
//            }
//            else
//            {
//                if ($cdsigmaTestValue->getVariantValue()->getValue()
//                    + $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
//                    > $cdsigmaTestValue->getProfilValue()->getValue())
//                {
//                    $abConformanceconformanceTestValue =
//                        (($cdsigmaTestValue->getVariantValue()->getValue()
//                                + $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()))
//                            - $cdsigmaTestValue->getProfilValue()->getValue())
//                        /($this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
//                            - $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue()));
//                }
//                else
//                {
//                    $abConformanceconformanceTestValue = 0;
//                }
//            }
//
//            if ($cdsigmaTestValue->getProfilValue()->getValue()
//                + $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue())
//                >= $cdsigmaTestValue->getVariantValue()->getValue())
//            {
//                $baConformanceconformanceTestValue = 1;
//            }
//            else
//            {
//                if ($cdsigmaTestValue->getProfilValue()->getValue()
//                    + $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
//                    > $cdsigmaTestValue->getVariantValue()->getValue())
//                {
//                    $baConformanceconformanceTestValue = (($cdsigmaTestValue->getProfilValue()->getValue()
//                                + $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()))
//                            - $cdsigmaTestValue->getVariantValue()->getValue())
//                        /($this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
//                            - $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue()));
//                }
//                else
//                {
//                    $baConformanceconformanceTestValue = 0;
//                }
//            }
//        }
//        else
//        {
//            if ($cdsigmaTestValue->getVariantValue()->getValue()
//                - $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue())
//                <=  $cdsigmaTestValue->getProfilValue()->getValue())
//            {
//                $abConformanceconformanceTestValue = 1;
//            }
//            else
//            {
//                if ($cdsigmaTestValue->getVariantValue()->getValue()
//                    - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
//                    < $cdsigmaTestValue->getProfilValue()->getValue())
//                {
//                    $abConformanceconformanceTestValue = ($cdsigmaTestValue->getProfilValue()->getValue()
//                            - ($cdsigmaTestValue->getVariantValue()->getValue()
//                                - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())))
//                        /($this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
//                            - $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue()));
//                }
//                else
//                {
//                    $abConformanceconformanceTestValue = 0;
//                }
//            }
//
//            if ($cdsigmaTestValue->getProfilValue()->getValue()
//                - $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue())
//                <= $cdsigmaTestValue->getVariantValue()->getValue())
//            {
//                $baConformanceconformanceTestValue = 1;
//            }
//            else
//            {
//                if ($cdsigmaTestValue->getProfilValue()->getValue()
//                    - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
//                    < $cdsigmaTestValue->getVariantValue()->getValue())
//                {
//                    $baConformanceconformanceTestValue = ($cdsigmaTestValue->getVariantValue()->getValue()
//                            - ($cdsigmaTestValue->getProfilValue()->getValue()
//                                - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())))
//                        /($this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
//                            - $this->theresholdService->calculateQ($cdsigmaTestValue->getProfilValue()));
//                }
//                else
//                {
//                    $baConformanceconformanceTestValue = 0;
//                }
//            }
//        }
//
//        $cdsigmaTestValue->setAbConformanceTestValue($abConformanceconformanceTestValue);
//        $cdsigmaTestValue->setBaConformanceTestValue($baConformanceconformanceTestValue);
//    }

//    private function calculateValueNonCompatibilityTest(cdsigmaTestValue $cdsigmaTestValue)
//    {
//        if ($cdsigmaTestValue->getVariantValue()->getCritery()->getCostGain() == 1)
//        {
//            if ($cdsigmaTestValue->getVariantValue()->getValue()
//                + $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
//                >= $cdsigmaTestValue->getProfilValue()->getValue())
//            {
//                $abNonconformanceconformanceTestValue = 0;
//            }
//            else
//            {
//                if ($cdsigmaTestValue->getVariantValue()->getValue()
//                    + $this->theresholdService->calculateV($cdsigmaTestValue->getProfilValue())
//                    > $cdsigmaTestValue->getProfilValue()->getValue())
//                {
//                    $abNonconformanceconformanceTestValue = ($cdsigmaTestValue->getProfilValue()->getValue()
//                            - ($cdsigmaTestValue->getVariantValue()->getValue()
//                                + $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())))
//                        /($this->theresholdService->calculateV($cdsigmaTestValue->getProfilValue())
//                            - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()));
//                }
//                else
//                {
//                    $abNonconformanceconformanceTestValue = 1;
//                }
//            }
//
//            if ($cdsigmaTestValue->getProfilValue()->getValue()
//                + $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
//                >= $cdsigmaTestValue->getVariantValue()->getValue())
//            {
//                $baNonconformanceconformanceTestValue = 0;
//            }
//            else
//            {
//                if ($cdsigmaTestValue->getProfilValue()->getValue()
//                    + $this->theresholdService->calculateV($cdsigmaTestValue->getProfilValue())
//                    > $cdsigmaTestValue->getVariantValue()->getValue())
//                {
//                    $baNonconformanceconformanceTestValue = ($cdsigmaTestValue->getVariantValue()->getValue()
//                            - ($cdsigmaTestValue->getProfilValue()->getValue()
//                                + $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())))
//                        /($this->theresholdService->calculateV($cdsigmaTestValue->getProfilValue())
//                            - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()));
//                }
//                else
//                {
//                    $baNonconformanceconformanceTestValue = 1;
//                }
//            }
//        }
//        else
//        {
//            if ($cdsigmaTestValue->getVariantValue()->getValue()
//                - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
//                <= $cdsigmaTestValue->getProfilValue()->getValue())
//            {
//                $abNonconformanceconformanceTestValue = 0;
//            }
//            else
//            {
//                if ($cdsigmaTestValue->getVariantValue()->getValue()
//                    - $this->theresholdService->calculateV($cdsigmaTestValue->getProfilValue())
//                    < $cdsigmaTestValue->getProfilValue()->getValue())
//                {
//                    $abNonconformanceconformanceTestValue = (($cdsigmaTestValue->getVariantValue()->getValue()
//                                - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()))
//                            - $cdsigmaTestValue->getProfilValue()->getValue())
//                        /($this->theresholdService->calculateV($cdsigmaTestValue->getProfilValue())
//                            - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()));
//                }
//                else
//                {
//                    $abNonconformanceconformanceTestValue = 1;
//                }
//            }
//
//            if ($cdsigmaTestValue->getProfilValue()->getValue()
//                - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue())
//                <= $cdsigmaTestValue->getVariantValue()->getValue())
//            {
//                $baNonconformanceconformanceTestValue = 0;
//            }
//            else
//            {
//                if ($cdsigmaTestValue->getProfilValue()->getValue()
//                    - $this->theresholdService->calculateV($cdsigmaTestValue->getProfilValue())
//                    < $cdsigmaTestValue->getVariantValue()->getValue())
//                {
//                    $baNonconformanceconformanceTestValue = (($cdsigmaTestValue->getProfilValue()->getValue()
//                                - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()))
//                            - $cdsigmaTestValue->getVariantValue()->getValue())
//                        /($this->theresholdService->calculateV($cdsigmaTestValue->getProfilValue())
//                            - $this->theresholdService->calculateP($cdsigmaTestValue->getProfilValue()));
//                }
//                else
//                {
//                    $baNonconformanceconformanceTestValue = 1;
//                }
//            }
//        }
//
//        $cdsigmaTestValue->setAbNonconformanceTestValue($abNonconformanceconformanceTestValue);
//        $cdsigmaTestValue->setBaNonconformanceTestValue($baNonconformanceconformanceTestValue);
//    }

//    private function calculateWeighedAverageFromCdSigma(cdsigmaTestValue $cdsigmaTestValue)
//    {
//        $weighedAverageA = 0;
//        $weighedAverageB = 0;
//        $sumWeight = 0;
//
//        $filteredTestIndex = $this->testIndex->filter(function ($element) use ($cdsigmaTestValue) {
//            return $element->getVariantValue()->getVariant() == $cdsigmaTestValue->getVariantValue()->getVariant()
//                && $element->getProfilValue()->getProfil() == $cdsigmaTestValue->getProfilValue()->getProfil();
//        });
//
//        foreach ($filteredTestIndex as $cdsigmaTestValue)
//        {
//            $weighedAverageA +=  $cdsigmaTestValue->getAbConformanceTestValue()
//                * $cdsigmaTestValue->getVariantValue()->getCritery()->getWeight();
//
//            $weighedAverageB += $cdsigmaTestValue->getBaConformanceTestValue()
//                * $cdsigmaTestValue->getProfilValue()->getCritery()->getWeight();
//
//            $sumWeight += $cdsigmaTestValue->getVariantValue()->getCritery()->getWeight();
//        }
//
//        $weighedAverageA = $weighedAverageA / $sumWeight;
//        $weighedAverageB = $weighedAverageB / $sumWeight;
//
//        return [
//            'weighedAverageA' => $weighedAverageA,
//            'weighedAverageB' => $weighedAverageB
//        ];
//    }

//    private function calculateCredibilityIndexValue(cdsigmaTestValue $cdsigmaTestValue)
//    {
//        $weighedAverage = $this->calculateWeighedAverageFromCdSigma($cdsigmaTestValue);
//
//        if ($cdsigmaTestValue->getAbNonconformanceTestValue() > $weighedAverage['weighedAverageA'])
//        {
//            if (1 - $weighedAverage['weighedAverageA'] == 0)
//            {
//                $abCredibilityIndex = 0;
//            }
//            else
//            {
//                $abCredibilityIndex = (1 - $cdsigmaTestValue->getAbNonconformanceTestValue())
//                    / (1 - $weighedAverage['weighedAverageA']);
//            }
//        }
//        else
//        {
//            $abCredibilityIndex = 1;
//        }
//
//        if ($cdsigmaTestValue->getBaNonconformanceTestValue() > $weighedAverage['weighedAverageB'])
//        {
//            $baCredibilityIndex = 0;
//
//            if (1 - $weighedAverage['weighedAverageB'] != 0)
//            {
//                $baCredibilityIndex = (1 - $cdsigmaTestValue->getBaNonconformanceTestValue())
//                    / (1 - $weighedAverage['weighedAverageB']);
//            }
//        }
//        else
//        {
//            $baCredibilityIndex = 1;
//        }
//
//        $cdsigmaTestValue->setAbCredibilityIndex($abCredibilityIndex);
//        $cdsigmaTestValue->setBaCredibilityIndex($baCredibilityIndex);
//    }

//    private function calculateVariantsProfilsCredibilityIndex()
//    {
//        foreach ($this->project->getVariant() as $variant)
//        {
//            foreach ($this->project->getProfil() as $profil)
//            {
//                $variantProfilCredibilityIndexRelation = new variantProfilCredibilityIndexRelation($variant, $profil);
//                $this->calculateVariantProfilCredibilityIndexValue($variantProfilCredibilityIndexRelation);
//                $this->checkRelation($variantProfilCredibilityIndexRelation);
//                $this->variantsProfilsCredibilityIndexRelation->add($variantProfilCredibilityIndexRelation);
//            }
//        }
//    }

//    private function calculateWeighedAverageAndMultipy(
//        variantProfilCredibilityIndexRelation $variantProfilCredibilityIndexRelation)
//    {
//        $weighedAverageA = 0;
//        $weighedAverageB = 0;
//        $sumWeight = 0;
//        $multiplyA = 1;
//        $multiplyB = 1;
//
//        $filteredTestIndex = $this->testIndex->filter(function ($element) use ($variantProfilCredibilityIndexRelation) {
//            return $element->getVariantValue()->getVariant() == $variantProfilCredibilityIndexRelation->getVariant()
//                && $element->getProfilValue()->getProfil() == $variantProfilCredibilityIndexRelation->getProfil();
//        });
//
//        foreach ($filteredTestIndex as $cdsigmaTestValue)
//        {
//            $weighedAverageA +=  $cdsigmaTestValue->getAbConformanceTestValue()
//                * $cdsigmaTestValue->getVariantValue()->getCritery()->getWeight();
//
//            $weighedAverageB += $cdsigmaTestValue->getBaConformanceTestValue()
//                * $cdsigmaTestValue->getProfilValue()->getCritery()->getWeight();
//
//            $sumWeight += $cdsigmaTestValue->getVariantValue()->getCritery()->getWeight();
//        }
//
//        $weighedAverageA = $weighedAverageA / $sumWeight;
//        $weighedAverageB = $weighedAverageB / $sumWeight;
//
//        foreach ($filteredTestIndex as $cdsigmaTestValue)
//        {
//            $multiplyA *= $cdsigmaTestValue->getAbCredibilityIndex();
//            $multiplyB *= $cdsigmaTestValue->getBaCredibilityIndex();
//        }
//
//        $multiplyA *= $weighedAverageA;
//        $multiplyB *= $weighedAverageB;
//
//        return [
//            'weighedAverageA' => $weighedAverageA,
//            'multiplyA' => $multiplyA,
//            'weighedAverageB' => $weighedAverageB,
//            'multiplyB' => $multiplyB,
//        ];
//    }

//    private function calculateVariantProfilCredibilityIndexValue(
//        variantProfilCredibilityIndexRelation $variantProfilCredibilityIndexRelation)
//    {
//        if ($this->calculateWeighedAverageAndMultipy($variantProfilCredibilityIndexRelation)['weighedAverageA'] >= $this->project->getCutOffLevel())
//        {
//            $variantCredibilityIndex = $this->calculateWeighedAverageAndMultipy($variantProfilCredibilityIndexRelation)['multiplyA'];
//        }
//        else
//        {
//            $variantCredibilityIndex = $this->calculateWeighedAverageAndMultipy($variantProfilCredibilityIndexRelation)['weighedAverageA'];
//        }
//
//        if ($this->calculateWeighedAverageAndMultipy($variantProfilCredibilityIndexRelation)['weighedAverageB'] >= $this->project->getCutOffLevel())
//        {
//            $profilCredibilityIndex = $this->calculateWeighedAverageAndMultipy($variantProfilCredibilityIndexRelation)['weighedAverageB'];
//        }
//        else
//        {
//            $profilCredibilityIndex = $this->calculateWeighedAverageAndMultipy($variantProfilCredibilityIndexRelation)['weighedAverageB'];
//        }
//
//        $variantProfilCredibilityIndexRelation->setVariantCredibilityIndex($variantCredibilityIndex);
//        $variantProfilCredibilityIndexRelation->setProfilCredibilityIndex($profilCredibilityIndex);
//    }

//    private function checkRelation(variantProfilCredibilityIndexRelation $variantProfilCredibilityIndexRelation)
//    {
//        if ($variantProfilCredibilityIndexRelation->getVariantCredibilityIndex() >= $this->project->getCutOffLevel()
//            && $variantProfilCredibilityIndexRelation->getProfilCredibilityIndex() >= $this->project->getCutOffLevel())
//        {
//            $relation = 'I';
//        }
//        elseif ($variantProfilCredibilityIndexRelation->getVariantCredibilityIndex() >= $this->project->getCutOffLevel()
//            && $variantProfilCredibilityIndexRelation->getProfilCredibilityIndex() < $this->project->getCutOffLevel())
//        {
//            $relation = '>';
//        }
//        elseif ($variantProfilCredibilityIndexRelation->getVariantCredibilityIndex() < $this->project->getCutOffLevel()
//            && $variantProfilCredibilityIndexRelation->getProfilCredibilityIndex() >= $this->project->getCutOffLevel())
//        {
//            $relation = '<';
//        }
//        else
//        {
//            $relation = 'R';
//        }
//
//        $variantProfilCredibilityIndexRelation->setRelation($relation);
//    }

//    private function assignVariantsKlas()
//    {
//        foreach ($this->project->getVariant() as $variant)
//        {
//            $variantKlas = new variantKlas($variant);
//            $this->assignVariantKlas($variantKlas);
//            $this->variantsKlas->add($variantKlas);
//        }
//    }

//    private function orderByProfilOrderASC(ArrayCollection $collection)
//    {
//        $iterator = $collection->getIterator();
//        $arrayCollection = new ArrayCollection();
//
//        $iterator->uasort(function ($first, $second)
//        {
//            return (int) $first->getProfil()->getProfilOrder() > (int) $second->getProfil()->getProfilOrder() ? 1 : -1;
//        });
//
//        $array = iterator_to_array($iterator);
//
//        foreach ($array as $item)
//        {
//            $arrayCollection->add($item);
//        }
//
//        return $arrayCollection;
//    }

//    private function orderByProfilOrderDESC(ArrayCollection $collection)
//    {
//        $iterator = $collection->getIterator();
//        $arrayCollection = new ArrayCollection();
//
//        $iterator->uasort(function ($first, $second)
//        {
//            return (int) $first->getProfil()->getProfilOrder() > (int) $second->getProfil()->getProfilOrder() ? -1 : 1;
//        });
//
//        $array = iterator_to_array($iterator);
//
//        foreach ($array as $item)
//        {
//            $arrayCollection->add($item);
//        }
//
//        return $arrayCollection;
//    }

//    private function orderByKlasOrderASC($collection)
//    {
//        $iterator = $collection->getIterator();
//        $arrayCollection = new ArrayCollection();
//
//        $iterator->uasort(function ($first, $second)
//        {
//            return (int) $first->getKlasOrder() > (int) $second->getKlasOrder() ? 1 : -1;
//        });
//
//        $array = iterator_to_array($iterator);
//
//        foreach ($array as $item)
//        {
//            $arrayCollection->add($item);
//        }
//
//        return $arrayCollection;
//    }

//    private function assignVariantKlas(variantKlas $variantKlas)
//    {
//        $klas = $this->project->getKlas();
//        $filteredVariantsProfilsCredibilityIndexRelation = $this->variantsProfilsCredibilityIndexRelation->filter(function ($element) use ($variantKlas)
//        {
//            return $element->getVariant() == $variantKlas->getVariant();
//        });
//
//        $orderedVariantsProfilsCredibilityIndexRelationASC = $this->orderByProfilOrderASC($filteredVariantsProfilsCredibilityIndexRelation);
//        $orderedVariantsProfilsCredibilityIndexRelationDESC = $this->orderByProfilOrderDESC($filteredVariantsProfilsCredibilityIndexRelation);
//        $klasASC = $this->orderByKlasOrderASC($klas);
//        $profilCounter =  count($orderedVariantsProfilsCredibilityIndexRelationDESC);
//
//        foreach ($orderedVariantsProfilsCredibilityIndexRelationASC as $key=>$variantProfilCredibilityIndexRelation)
//        {
//            if ($variantProfilCredibilityIndexRelation->getRelation() == '<')
//            {
//                $optimisticAssignedKlas = $klasASC[$key];
//            }
//            else
//            {
//                $optimisticAssignedKlas = $klasASC[$key+1];
//            }
//        }
//
//        foreach ($orderedVariantsProfilsCredibilityIndexRelationDESC as $key=>$variantProfilCredibilityIndexRelation)
//        {
//
//            if ($variantProfilCredibilityIndexRelation->getRelation() == '>'
//                || $variantProfilCredibilityIndexRelation->getRelation() == 'I')
//            {
//                $pessimisticAssignedKlas = $klasASC[$profilCounter - $key];
//                break;
//            }
//            elseif ($variantProfilCredibilityIndexRelation->getRelation() == '<')
//            {
//                $pessimisticAssignedKlas = $klasASC[$key];
//            }
//            else
//            {
//                $pessimisticAssignedKlas = $klasASC[0];
//            }
//        }
//
//        $variantKlas->setOptimisticAssignedKlas($optimisticAssignedKlas);
//        $variantKlas->setPessimisticAssignedKlas($pessimisticAssignedKlas);
//    }
}
