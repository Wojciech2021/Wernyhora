<?php

namespace App\Entity;

use App\Repository\ProfilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProfilRepository::class)]
class Profil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'Profil')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Project $Project = null;

    #[ORM\OneToMany(mappedBy: 'Profil', targetEntity: ProfilValue::class, orphanRemoval: true)]
    #[Groups(['group1'])]
    private Collection $ProfilValue;

    #[ORM\Column]
    #[Groups(['group1'])]
    private ?int $profilOrder = null;

    #[ORM\Column]
    #[Groups(['group1'])]
    private ?int $colorR = null;

    #[ORM\Column]
    #[Groups(['group1'])]
    private ?int $colorG = null;

    #[ORM\Column]
    #[Groups(['group1'])]
    private ?int $colorB = null;

    #[ORM\Column]
    #[Groups(['group1'])]
    private ?int $colorRQ = null;

    #[ORM\Column]
    #[Groups(['group1'])]
    private ?int $colorGQ = null;

    #[ORM\Column]
    #[Groups(['group1'])]
    private ?int $colorBQ = null;

    #[ORM\Column]
    #[Groups(['group1'])]
    private ?int $colorRP = null;

    #[ORM\Column]
    #[Groups(['group1'])]
    private ?int $colorGP = null;

    #[ORM\Column]
    #[Groups(['group1'])]
    private ?int $colorBP = null;

    #[ORM\Column]
    #[Groups(['group1'])]
    private ?int $colorRV = null;

    #[ORM\Column]
    #[Groups(['group1'])]
    private ?int $colorGV = null;

    #[ORM\Column]
    #[Groups(['group1'])]
    private ?int $colorBV = null;

    public function __construct()
    {
        $this->ProfilValue = new ArrayCollection();

        $this->colorR = rand(0,255);
        $this->colorG = rand(0,255);
        $this->colorB = rand(0,255);

        $this->colorRP = rand(0,255);
        $this->colorGP = rand(0,255);
        $this->colorBP = rand(0,255);

        $this->colorRQ = rand(0,255);
        $this->colorGQ = rand(0,255);
        $this->colorBQ = rand(0,255);

        $this->colorRV = rand(0,255);
        $this->colorGV = rand(0,255);
        $this->colorBV = rand(0,255);
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $profilValue->setProfil($this);
        }

        return $this;
    }

    public function removeProfilValue(ProfilValue $profilValue): self
    {
        if ($this->ProfilValue->removeElement($profilValue)) {
            // set the owning side to null (unless already changed)
            if ($profilValue->getProfil() === $this) {
                $profilValue->setProfil(null);
            }
        }

        return $this;
    }

    public function getProfilOrder(): ?int
    {
        return $this->profilOrder;
    }

    public function setProfilOrder(?int $profilOrder): self
    {
        $this->profilOrder = $profilOrder;

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

    public function getColorRQ(): ?int
    {
        return $this->colorRQ;
    }

    public function setColorRQ(int $colorRQ): self
    {
        $this->colorRQ = $colorRQ;

        return $this;
    }

    public function getColorGQ(): ?int
    {
        return $this->colorGQ;
    }

    public function setColorGQ(int $colorGQ): self
    {
        $this->colorGQ = $colorGQ;

        return $this;
    }

    public function getColorBQ(): ?int
    {
        return $this->colorBQ;
    }

    public function setColorBQ(int $colorBQ): self
    {
        $this->colorBQ = $colorBQ;

        return $this;
    }

    public function getColorRP(): ?int
    {
        return $this->colorRP;
    }

    public function setColorRP(int $colorRP): self
    {
        $this->colorRP = $colorRP;

        return $this;
    }

    public function getColorGP(): ?int
    {
        return $this->colorGP;
    }

    public function setColorGP(int $colorGP): self
    {
        $this->colorGP = $colorGP;

        return $this;
    }

    public function getColorBP(): ?int
    {
        return $this->colorBP;
    }

    public function setColorBP(int $colorBP): self
    {
        $this->colorBP = $colorBP;

        return $this;
    }

    public function getColorRV(): ?int
    {
        return $this->colorRV;
    }

    public function setColorRV(int $colorRV): self
    {
        $this->colorRV = $colorRV;

        return $this;
    }

    public function getColorGV(): ?int
    {
        return $this->colorGV;
    }

    public function setColorGV(int $colorGV): self
    {
        $this->colorGV = $colorGV;

        return $this;
    }

    public function getColorBV(): ?int
    {
        return $this->colorBV;
    }

    public function setColorBV(int $colorBV): self
    {
        $this->colorBV = $colorBV;

        return $this;
    }
}
