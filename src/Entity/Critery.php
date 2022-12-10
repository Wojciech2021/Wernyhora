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

    #[ORM\Column(nullable: true)]
    private ?float $alfaQ = null;

    #[ORM\Column(nullable: true)]
    private ?float $betaQ = null;

    #[ORM\Column(nullable: true)]
    private ?float $alfaP = null;

    #[ORM\Column(nullable: true)]
    private ?float $betaP = null;

    #[ORM\Column(nullable: true)]
    private ?float $alfaV = null;

    #[ORM\Column(nullable: true)]
    private ?float $betaV = null;

    #[ORM\OneToMany(mappedBy: 'Critery', targetEntity: ProfilValue::class, orphanRemoval: true)]
    private Collection $ProfilValue;

    #[ORM\Column]
    private ?int $CostGain = null;

    public function __construct()
    {
        $this->VariantValue = new ArrayCollection();
        $this->ProfilValue = new ArrayCollection();
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

    public function getAlfaQ(): ?float
    {
        return $this->alfaQ;
    }

    public function setAlfaQ(?float $alfaQ): self
    {
        $this->alfaQ = $alfaQ;

        return $this;
    }

    public function getBetaQ(): ?float
    {
        return $this->betaQ;
    }

    public function setBetaQ(?float $betaQ): self
    {
        $this->betaQ = $betaQ;

        return $this;
    }

    public function getAlfaP(): ?float
    {
        return $this->alfaP;
    }

    public function setAlfaP(?float $alfaP): self
    {
        $this->alfaP = $alfaP;

        return $this;
    }

    public function getBetaP(): ?float
    {
        return $this->betaP;
    }

    public function setBetaP(?float $betaP): self
    {
        $this->betaP = $betaP;

        return $this;
    }

    public function getAlfaV(): ?float
    {
        return $this->alfaV;
    }

    public function setAlfaV(?float $alfaV): self
    {
        $this->alfaV = $alfaV;

        return $this;
    }

    public function getBetaV(): ?float
    {
        return $this->betaV;
    }

    public function setBetaV(?float $betaV): self
    {
        $this->betaV = $betaV;

        return $this;
    }

    /**
     * @return Collection<int, ProfilValue>
     */
    public function getProfilValue(): Collection
    {
        return $this->ProfilValue;
    }

    public function addProfilValue(ProfilValue $profilValue): self
    {
        if (!$this->ProfilValue->contains($profilValue)) {
            $this->ProfilValue->add($profilValue);
            $profilValue->setCritery($this);
        }

        return $this;
    }

    public function removeProfilValue(ProfilValue $profilValue): self
    {
        if ($this->ProfilValue->removeElement($profilValue)) {
            // set the owning side to null (unless already changed)
            if ($profilValue->getCritery() === $this) {
                $profilValue->setCritery(null);
            }
        }

        return $this;
    }

    public function getCostGain(): ?int
    {
        return $this->CostGain;
    }

    public function setCostGain(int $CostGain): self
    {
        $this->CostGain = $CostGain;

        return $this;
    }
}
