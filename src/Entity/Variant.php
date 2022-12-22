<?php

namespace App\Entity;

use App\Repository\VariantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VariantRepository::class)]
class Variant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'Variant')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Project $Project = null;

    #[ORM\OneToMany(mappedBy: 'Variant', targetEntity: VariantValue::class, orphanRemoval: true)]
    private Collection $VariantValue;

    #[ORM\Column]
    private ?int $colorR = null;

    #[ORM\Column]
    private ?int $colorG = null;

    #[ORM\Column]
    private ?int $colorB = null;

    public function __construct()
    {
        $this->VariantValue = new ArrayCollection();

        $this->colorR = rand(0,255);
        $this->colorG = rand(0,255);
        $this->colorB = rand(0,255);
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

    public function getProject(): ?Project
    {
        return $this->Project;
    }

    public function setProject(?Project $Project): self
    {
        $this->Project = $Project;

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
            $variantValue->setVariant($this);
        }

        return $this;
    }

    public function removeVariantValue(VariantValue $variantValue): self
    {
        if ($this->VariantValue->removeElement($variantValue)) {
            // set the owning side to null (unless already changed)
            if ($variantValue->getVariant() === $this) {
                $variantValue->setVariant(null);
            }
        }

        return $this;
    }

    public function getColorR(): ?int
    {
        return $this->colorR;
    }

    public function setColorR(int $colorR): self
    {
        $this->colorR = $colorR;

        return $this;
    }

    public function getColorG(): ?int
    {
        return $this->colorG;
    }

    public function setColorG(int $colorG): self
    {
        $this->colorG = $colorG;

        return $this;
    }

    public function getColorB(): ?int
    {
        return $this->colorB;
    }

    public function setColorB(int $colorB): self
    {
        $this->colorB = $colorB;

        return $this;
    }
}
