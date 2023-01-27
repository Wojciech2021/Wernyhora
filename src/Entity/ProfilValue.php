<?php

namespace App\Entity;

use App\Repository\ProfilValueRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProfilValueRepository::class)]
class ProfilValue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['group1'])]
    private ?float $value = null;

    #[ORM\ManyToOne(inversedBy: 'ProfilValue')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Critery $Critery = null;

    #[ORM\ManyToOne(inversedBy: 'ProfilValue')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Profil $Profil = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(?float $value): self
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

    public function getProfil(): ?Profil
    {
        return $this->Profil;
    }

    public function setProfil(?Profil $Profil): self
    {
        $this->Profil = $Profil;

        return $this;
    }
}
