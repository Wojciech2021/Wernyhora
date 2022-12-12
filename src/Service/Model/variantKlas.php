<?php

namespace App\Service\Model;

class variantKlas
{
    private $variant;
    private $optimisticAssignedKlas;
    private $pessimisticAssignedKlas;

    public function __construct($variant)
    {
        $this->variant = $variant;
    }

    /**
     * @return mixed
     */
    public function getVariant()
    {
        return $this->variant;
    }

    /**
     * @param mixed $variant
     */
    public function setVariant($variant): void
    {
        $this->variant = $variant;
    }

    /**
     * @return mixed
     */
    public function getOptimisticAssignedKlas()
    {
        return $this->optimisticAssignedKlas;
    }

    /**
     * @param mixed $optimisticAssignedKlas
     */
    public function setOptimisticAssignedKlas($optimisticAssignedKlas): void
    {
        $this->optimisticAssignedKlas = $optimisticAssignedKlas;
    }

    /**
     * @return mixed
     */
    public function getPessimisticAssignedKlas()
    {
        return $this->pessimisticAssignedKlas;
    }

    /**
     * @param mixed $pessimisticAssignedKlas
     */
    public function setPessimisticAssignedKlas($pessimisticAssignedKlas): void
    {
        $this->pessimisticAssignedKlas = $pessimisticAssignedKlas;
    }
}