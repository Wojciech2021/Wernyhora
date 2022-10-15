<?php

namespace App\Entity;

use App\Repository\VariantValueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VariantValueRepository::class)]
class VariantValue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $value = null;

    #[ORM\ManyToOne(inversedBy: 'VariantValue')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Critery $Critery = null;

    #[ORM\ManyToOne(inversedBy: 'VariantValue')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Variant $Variant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getCritery(): ?Critery
    {
        return $this->Critery;
    }

    public function setCritery(?Critery $Critery): self
    {
        $this->Critery = $Critery;

        return $this;
    }

    public function getVariant(): ?Variant
    {
        return $this->Variant;
    }

    public function setVariant(?Variant $Variant): self
    {
        $this->Variant = $Variant;

        return $this;
    }
}
