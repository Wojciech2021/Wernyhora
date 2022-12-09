<?php

namespace App\Service\Model;

use App\Entity\ProfilValue;
use App\Entity\VariantValue;

class cdsigmaTestValue
{

    private $variantValue;
    private $profilValue;
    private $abConformanceconformanceTestValue;
    private $baConformanceconformanceTestValue;
    private $abNonconformanceconformanceTestValue;
    private $baNonconformanceconformanceTestValue;
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
    public function getAbConformanceconformanceTestValue()
    {
        return $this->abConformanceconformanceTestValue;
    }

    /**
     * @param mixed $abConformanceconformanceTestValue
     */
    public function setAbConformanceconformanceTestValue($abConformanceconformanceTestValue): void
    {
        $this->abConformanceconformanceTestValue = $abConformanceconformanceTestValue;
    }

    /**
     * @return mixed
     */
    public function getBaConformanceconformanceTestValue()
    {
        return $this->baConformanceconformanceTestValue;
    }

    /**
     * @param mixed $baConformanceconformanceTestValue
     */
    public function setBaConformanceconformanceTestValue($baConformanceconformanceTestValue): void
    {
        $this->baConformanceconformanceTestValue = $baConformanceconformanceTestValue;
    }

    /**
     * @return mixed
     */
    public function getAbNonconformanceconformanceTestValue()
    {
        return $this->abNonconformanceconformanceTestValue;
    }

    /**
     * @param mixed $abNonconformanceconformanceTestValue
     */
    public function setAbNonconformanceconformanceTestValue($abNonconformanceconformanceTestValue): void
    {
        $this->abNonconformanceconformanceTestValue = $abNonconformanceconformanceTestValue;
    }

    /**
     * @return mixed
     */
    public function getBaNonconformanceconformanceTestValue()
    {
        return $this->baNonconformanceconformanceTestValue;
    }

    /**
     * @param mixed $baNonconformanceconformanceTestValue
     */
    public function setBaNonconformanceconformanceTestValue($baNonconformanceconformanceTestValue): void
    {
        $this->baNonconformanceconformanceTestValue = $baNonconformanceconformanceTestValue;
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