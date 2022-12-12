<?php

namespace App\Service\Model;

use App\Entity\Profil;
use App\Entity\Variant;

class variantProfilCredibilityIndexRelation
{
    private $variant;
    private $profil;
    private $variantCredibilityIndex;
    private $profilCredibilityIndex;
    private $relation;

    public function __construct(Variant $variant, Profil $profil)
    {
        $this->variant = $variant;
        $this->profil = $profil;
    }

    /**
     * @return Variant
     */
    public function getVariant(): Variant
    {
        return $this->variant;
    }

    /**
     * @param Variant $variant
     */
    public function setVariant(Variant $variant): void
    {
        $this->variant = $variant;
    }

    /**
     * @return Profil
     */
    public function getProfil(): Profil
    {
        return $this->profil;
    }

    /**
     * @param Profil $profil
     */
    public function setProfil(Profil $profil): void
    {
        $this->profil = $profil;
    }

    /**
     * @return mixed
     */
    public function getVariantCredibilityIndex()
    {
        return $this->variantCredibilityIndex;
    }

    /**
     * @param mixed $variantCredibilityIndex
     */
    public function setVariantCredibilityIndex($variantCredibilityIndex): void
    {
        $this->variantCredibilityIndex = $variantCredibilityIndex;
    }

    /**
     * @return mixed
     */
    public function getProfilCredibilityIndex()
    {
        return $this->profilCredibilityIndex;
    }

    /**
     * @param mixed $profilCredibilityIndex
     */
    public function setProfilCredibilityIndex($profilCredibilityIndex): void
    {
        $this->profilCredibilityIndex = $profilCredibilityIndex;
    }

    /**
     * @return mixed
     */
    public function getRelation()
    {
        return $this->relation;
    }

    /**
     * @param mixed $relation
     */
    public function setRelation($relation): void
    {
        $this->relation = $relation;
    }
}