<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Slug;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(unique: true, length: 255)]
    #[Slug(fields: ['name'])]
    #[Groups(['group1'])]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    #[Groups(['group1'])]
    private ?string $name = null;

    #[ORM\Column(length: 1024, nullable: true)]
    #[Groups(['group1'])]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'Projects')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creationTime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updateTime = null;

    #[ORM\OneToMany(mappedBy: 'Project', targetEntity: Critery::class, orphanRemoval: true)]
    #[Groups(['group1'])]
    private Collection $Critery;

    #[ORM\OneToMany(mappedBy: 'Project', targetEntity: Variant::class, orphanRemoval: true)]
    #[Groups(['group1'])]
    private Collection $Variant;

    #[ORM\OneToMany(mappedBy: 'Project', targetEntity: Klas::class, orphanRemoval: true)]
    #[Groups(['group1'])]
    private Collection $Klas;

    #[ORM\OneToMany(mappedBy: 'Project', targetEntity: Profil::class, orphanRemoval: true)]
    #[Groups(['group1'])]
    private Collection $Profil;

    #[ORM\Column(nullable: true)]
    #[Assert\GreaterThan(0.5)]
    #[Assert\LessThanOrEqual(1)]
    #[Groups(['group1'])]
    private ?float $CutOffLevel = null;

    public function __construct()
    {
        $this->Critery = new ArrayCollection();
        $this->Variant = new ArrayCollection();
        $this->Klas = new ArrayCollection();
        $this->Profil = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getCreationTime(): ?\DateTimeInterface
    {
        return $this->creationTime;
    }

    public function setCreationTime(\DateTimeInterface $creationTime): self
    {
        $this->creationTime = $creationTime;

        return $this;
    }

    public function getUpdateTime(): ?\DateTimeInterface
    {
        return $this->updateTime;
    }

    public function setUpdateTime(\DateTimeInterface $updateTime): self
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * @return Collection<int, Critery>
     */
    public function getCritery(): Collection
    {
        return $this->Critery;
    }

    public function addCritery(Critery $critery): self
    {
        if (!$this->Critery->contains($critery)) {
            $this->Critery->add($critery);
            $critery->setProject($this);
        }

        return $this;
    }

    public function removeCritery(Critery $critery): self
    {
        if ($this->Critery->removeElement($critery)) {
            // set the owning side to null (unless already changed)
            if ($critery->getProject() === $this) {
                $critery->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Variant>
     */
    public function getVariant(): Collection
    {
        return $this->Variant;
    }

    public function addVariant(Variant $variant): self
    {
        if (!$this->Variant->contains($variant)) {
            $this->Variant->add($variant);
            $variant->setProject($this);
        }

        return $this;
    }

    public function removeVariant(Variant $variant): self
    {
        if ($this->Variant->removeElement($variant)) {
            // set the owning side to null (unless already changed)
            if ($variant->getProject() === $this) {
                $variant->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Klas>
     */
    public function getKlas(): Collection
    {
        return $this->Klas;
    }

    public function addKlas(Klas $klas): self
    {
        if (!$this->Klas->contains($klas)) {
            $this->Klas->add($klas);
            $klas->setProject($this);
        }

        return $this;
    }

    public function removeKlas(Klas $klas): self
    {
        if ($this->Klas->removeElement($klas)) {
            // set the owning side to null (unless already changed)
            if ($klas->getProject() === $this) {
                $klas->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Profil>
     */
    public function getProfil(): Collection
    {
        return $this->Profil;
    }

    public function addProfil(Profil $profil): self
    {
        if (!$this->Profil->contains($profil)) {
            $this->Profil->add($profil);
            $profil->setProject($this);
        }

        return $this;
    }

    public function removeProfil(Profil $profil): self
    {
        if ($this->Profil->removeElement($profil)) {
            // set the owning side to null (unless already changed)
            if ($profil->getProject() === $this) {
                $profil->setProject(null);
            }
        }

        return $this;
    }

    public function getCutOffLevel(): ?float
    {
        return $this->CutOffLevel;
    }

    public function setCutOffLevel(float $CutOffLevel): self
    {
        $this->CutOffLevel = $CutOffLevel;

        return $this;
    }
}
