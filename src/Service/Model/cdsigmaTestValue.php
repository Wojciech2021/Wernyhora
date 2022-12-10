<?php

namespace App\Service\Model;

use App\Entity\ProfilValue;
use App\Entity\VariantValue;

class cdsigmaTestValue
{

    private $variantValue;
    private $profilValue;
    private $abConformanceTestValue;
    private $baConformanceTestValue;
    private $abNonconformanceTestValue;
    private $baNonconformanceTestValue;
    private $abCredibilityIndex;
    private $baCredibilityIndex;

    public function __construct(VariantValue $variantValue, ProfilValue $profilValue)
    {
        $this->variantValue = $variantValue;
        $this->profilValue = $profilValue;
    }

    /**
     * @return mixed
     */
    public function getVariantValue()
    {
        return $this->variantValue;
    }

    /**
     * @param mixed $variantValue
     */
    public function setVariantValue($variantValue): void
    {
        $this->variantValue = $variantValue;
    }

    /**
     * @return mixed
     */
    public function getProfilValue()
    {
        return $this->profilValue;
    }

    /**
     * @param mixed $profilValue
     */
    public function setProfilValue($profilValue): void
    {
        $this->profilValue = $profilValue;
    }

    /**
     * @return mixed
     */
    public function getAbConformanceTestValue()
    {
        return $this->abConformanceTestValue;
    }

    /**
     * @param mixed $abConformanceTestValue
     */
    public function setAbConformanceTestValue($abConformanceTestValue): void
    {
        $this->abConformanceTestValue = $abConformanceTestValue;
    }

    /**
     * @return mixed
     */
    public function getBaConformanceTestValue()
    {
        return $this->baConformanceTestValue;
    }

    /**
     * @param mixed $baConformanceTestValue
     */
    public function setBaConformanceTestValue($baConformanceTestValue): void
    {
        $this->baConformanceTestValue = $baConformanceTestValue;
    }

    /**
     * @return mixed
     */
    public function getAbNonconformanceTestValue()
    {
        return $this->abNonconformanceTestValue;
    }

    /**
     * @param mixed $abNonconformanceTestValue
     */
    public function setAbNonconformanceTestValue($abNonconformanceTestValue): void
    {
        $this->abNonconformanceTestValue = $abNonconformanceTestValue;
    }

    /**
     * @return mixed
     */
    public function getBaNonconformanceTestValue()
    {
        return $this->baNonconformanceTestValue;
    }

    /**
     * @param mixed $baNonconformanceTestValue
     */
    public function setBaNonconformanceTestValue($baNonconformanceTestValue): void
    {
        $this->baNonconformanceTestValue = $baNonconformanceTestValue;
    }

    /**
     * @return mixed
     */
    public function getAbCredibilityIndex()
    {
        return $this->abCredibilityIndex;
    }

    /**
     * @param mixed $abCredibilityIndex
     */
    public function setAbCredibilityIndex($abCredibilityIndex): void
    {
        $this->abCredibilityIndex = $abCredibilityIndex;
    }

    /**
     * @return mixed
     */
    public function getBaCredibilityIndex()
    {
        return $this->baCredibilityIndex;
    }

    /**
     * @param mixed $baCredibilityIndex
     */
    public function setBaCredibilityIndex($baCredibilityIndex): void
    {
        $this->baCredibilityIndex = $baCredibilityIndex;
    }
}