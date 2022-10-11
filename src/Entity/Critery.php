<?php

namespace App\Entity;

use App\Repository\CriteryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CriteryRepository::class)]
class Critery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $unit = null;

    #[ORM\ManyToOne(inversedBy: 'Critery')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Project $Project = null;

    #[ORM\Column]
    private ?float $weight = null;

    #[ORM\OneToMany(mappedBy: 'Critery', targetEntity: VariantValue::class, orphanRemoval: true)]
    private Collection $VariantValue;

    public function __construct()
    {
        $this->VariantValue = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(?string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->Project;
    }

    public function setProject(?Project $Project): self
    {
        $this->Project = $Project;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return Collection<int, VariantValue>
     */
    public function getVariantValue(): Collection
    {
        return $this->VariantValue;
    }

    public function addVariantValue(VariantValue $variantValue): self
    {
        if (!$this->VariantValue->contains($variantValue)) {
            $this->VariantValue->add($variantValue);
            $variantValue->setCritery($this);
        }

        return $this;
    }

    public function removeVariantValue(VariantValue $variantValue): self
    {
        if ($this->VariantValue->removeElement($variantValue)) {
            // set the owning side to null (unless already changed)
            if ($variantValue->getCritery() === $this) {
                $variantValue->setCritery(null);
            }
        }

        return $this;
    }
}
