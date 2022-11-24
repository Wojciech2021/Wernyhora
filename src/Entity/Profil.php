<?php

namespace App\Entity;

use App\Repository\ProfilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
    private Collection $ProfilValue;

    #[ORM\Column]
    private ?int $profilOrder = null;

    public function __construct()
    {
        $this->ProfilValue = new ArrayCollection();
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
}
