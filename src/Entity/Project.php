<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Slug;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(unique: true, length: 255)]
    #[Slug(fields: ['name'])]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 1024, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'Projects')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creationTime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updateTime = null;

    #[ORM\OneToMany(mappedBy: 'Project', targetEntity: Critery::class, orphanRemoval: true)]
    private Collection $Critery;

    #[ORM\OneToMany(mappedBy: 'Project', targetEntity: Variant::class, orphanRemoval: true)]
    private Collection $Variant;

    public function __construct()
    {
        $this->Critery = new ArrayCollection();
        $this->Variant = new ArrayCollection();
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
}
