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
}
