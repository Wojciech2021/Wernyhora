<?php

namespace App\Service;

use App\Service\Model\variantProfilCredibilityIndexRelation;
use Doctrine\Common\Collections\ArrayCollection;

class VariantProfilRelationService
{
    private $variantsProfilsCredibilityIndexRelation;
    private $variants;
    private $profils;
    private $testIndex;
    private $project;

    public function __construct($variants, $profils, $testIndex, $project)
    {
        $this->variantsProfilsCredibilityIndexRelation = new ArrayCollection();
        $this->variants = $variants;
        $this->profils = $profils;
        $this->testIndex = $testIndex;
        $this->project = $project;
    }

    /**
     * @return ArrayCollection
     */
    public function getVariantProfilCredibilityIndexRelation(): ArrayCollection
    {
        $this->calculateVariantsProfilsCredibilityIndex();
        return $this->variantsProfilsCredibilityIndexRelation;
    }

    private function calculateVariantsProfilsCredibilityIndex()
    {
        foreach ($this->variants as $variant)
        {
            foreach ($this->profils as $profil)
            {
                $variantProfilCredibilityIndexRelation = new variantProfilCredibilityIndexRelation($variant, $profil);
                $this->calculateVariantProfilCredibilityIndexValue($variantProfilCredibilityIndexRelation);
                $this->checkRelation($variantProfilCredibilityIndexRelation);
                $this->variantsProfilsCredibilityIndexRelation->add($variantProfilCredibilityIndexRelation);
            }
        }
    }

    private function calculateWeighedAverageAndMultipy(
        variantProfilCredibilityIndexRelation $variantProfilCredibilityIndexRelation)
    {
        $weighedAverageA = 0;
        $weighedAverageB = 0;
        $sumWeight = 0;
        $multiplyA = 1;
        $multiplyB = 1;

        $filteredTestIndex = $this->testIndex->filter(function ($element) use ($variantProfilCredibilityIndexRelation) {
            return $element->getVariantValue()->getVariant() == $variantProfilCredibilityIndexRelation->getVariant()
                && $element->getProfilValue()->getProfil() == $variantProfilCredibilityIndexRelation->getProfil();
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

        foreach ($filteredTestIndex as $cdsigmaTestValue)
        {
            $multiplyA *= $cdsigmaTestValue->getAbCredibilityIndex();
            $multiplyB *= $cdsigmaTestValue->getBaCredibilityIndex();
        }

        $multiplyA *= $weighedAverageA;
        $multiplyB *= $weighedAverageB;

        return [
            'weighedAverageA' => $weighedAverageA,
            'multiplyA' => $multiplyA,
            'weighedAverageB' => $weighedAverageB,
            'multiplyB' => $multiplyB,
        ];
    }

    private function calculateVariantProfilCredibilityIndexValue(
        variantProfilCredibilityIndexRelation $variantProfilCredibilityIndexRelation)
    {
        if ($this->calculateWeighedAverageAndMultipy($variantProfilCredibilityIndexRelation)['weighedAverageA']
            >= $this->project->getCutOffLevel())
        {
            $variantCredibilityIndex
                = $this->calculateWeighedAverageAndMultipy($variantProfilCredibilityIndexRelation)['multiplyA'];
        }
        else
        {
            $variantCredibilityIndex
                = $this->calculateWeighedAverageAndMultipy($variantProfilCredibilityIndexRelation)['weighedAverageA'];
        }

        if ($this->calculateWeighedAverageAndMultipy($variantProfilCredibilityIndexRelation)['weighedAverageB']
            >= $this->project->getCutOffLevel())
        {
            $profilCredibilityIndex
                = $this->calculateWeighedAverageAndMultipy($variantProfilCredibilityIndexRelation)['weighedAverageB'];
        }
        else
        {
            $profilCredibilityIndex
                = $this->calculateWeighedAverageAndMultipy($variantProfilCredibilityIndexRelation)['weighedAverageB'];
        }

        $variantProfilCredibilityIndexRelation->setVariantCredibilityIndex($variantCredibilityIndex);
        $variantProfilCredibilityIndexRelation->setProfilCredibilityIndex($profilCredibilityIndex);
    }

    private function checkRelation(variantProfilCredibilityIndexRelation $variantProfilCredibilityIndexRelation)
    {
        if ($variantProfilCredibilityIndexRelation->getVariantCredibilityIndex() >= $this->project->getCutOffLevel()
            && $variantProfilCredibilityIndexRelation->getProfilCredibilityIndex() >= $this->project->getCutOffLevel())
        {
            $relation = 'I';
        }
        elseif ($variantProfilCredibilityIndexRelation->getVariantCredibilityIndex() >= $this->project->getCutOffLevel()
            && $variantProfilCredibilityIndexRelation->getProfilCredibilityIndex() < $this->project->getCutOffLevel())
        {
            $relation = '>';
        }
        elseif ($variantProfilCredibilityIndexRelation->getVariantCredibilityIndex() < $this->project->getCutOffLevel()
            && $variantProfilCredibilityIndexRelation->getProfilCredibilityIndex() >= $this->project->getCutOffLevel())
        {
            $relation = '<';
        }
        else
        {
            $relation = 'R';
        }

        $variantProfilCredibilityIndexRelation->setRelation($relation);
    }
}