<?php

namespace App\Service;

use App\Entity\Critery;
use App\Entity\Klas;
use App\Entity\Profil;
use App\Entity\ProfilValue;
use App\Entity\Project;
use App\Entity\User;
use App\Entity\Variant;
use App\Entity\VariantValue;
use App\Repository\CriteryRepository;
use App\Repository\KlasRepository;
use App\Repository\ProfilRepository;
use App\Repository\ProfilValueRepository;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use App\Repository\VariantRepository;
use App\Repository\VariantValueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class ProjectsService
{

    private $userRepository;
    private $projectRepository;
    private $criteryRepository;
    private $variantRepository;
    private $variantValueRepository;
    private $klasRepository;
    private $profilRepository;
    private $profilValueRepository;
    private $user;

    public function __construct(UserRepository         $userRepository,
                                ProjectRepository      $projectRepository,
                                CriteryRepository      $criteryRepository,
                                VariantRepository      $variantRepository,
                                VariantValueRepository $variantValueRepository,
                                KlasRepository         $klasRepository,
                                ProfilRepository       $profilRepository,
                                ProfilValueRepository  $profilValueRepository)
    {
        $this->userRepository = $userRepository;
        $this->projectRepository = $projectRepository;
        $this->criteryRepository =$criteryRepository;
        $this->variantRepository = $variantRepository;
        $this->variantValueRepository = $variantValueRepository;
        $this->klasRepository = $klasRepository;
        $this->profilRepository = $profilRepository;
        $this->profilValueRepository = $profilValueRepository;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function addNewProject(Project $project)
    {
        $now = new \DateTime();
        $project->setUser($this->user);
        $project->setCreationTime($now);
        $project->setUpdateTime($now);
        $this->projectRepository->save($project, true);
    }

    public function gettAllProjects()
    {
        if ($this->user)
        {
            $projectsArray = $this->user->getProjects();

            return $projectsArray;
        }
        else
        {
            return null;
        }
    }

    public function updateProject(Project $project)
    {
        $now = new \DateTime();
        $project->setUpdateTime($now);
        $this->projectRepository->save($project, true);
    }

    public function getProject(int $id)
    {
        return $this->projectRepository->find($id);
    }

    public function deleteProject(Project $project)
    {
        $this->user->removeProject($project);
        $this->userRepository->save($this->user, true);
    }

    public function importProject($projectImported)
    {
        $now = new \DateTime();
        $project = new Project();
        $project->setUser($this->user);
        $project->setName($projectImported->name);
        $project->setDescription($projectImported->description);
        $project->setCutOffLevel($projectImported->CutOffLevel);
        $project->setCreationTime($now);
        $project->setUpdateTime($now);

        $criteries = new ArrayCollection();
        $variants = new ArrayCollection();
        $profils = new ArrayCollection();

        $klases = new ArrayCollection();

        foreach ($projectImported->Critery as $criteryImported)
        {
            $critery = new Critery();
            $critery->setName($criteryImported->name);
            $critery->setProject($project);
            $critery->setUnit($criteryImported->unit);
            $critery->setWeight($criteryImported->weight);
            $critery->setAlfaQ($criteryImported->alfaQ);
            $critery->setBetaQ($criteryImported->betaQ);
            $critery->setAlfaP($criteryImported->alfaP);
            $critery->setBetaP($criteryImported->betaP);
            $critery->setAlfaV($criteryImported->alfaV);
            $critery->setBetaV($criteryImported->betaV);
            $critery->setCostGain($criteryImported->CostGain);
            $criteries->add($critery);
            $project->addCritery($critery);

            $this->criteryRepository->save($critery, false);
        }

        foreach ($projectImported->Variant as $variantImported)
        {
            $variant = new Variant();
            $variant->setName($variantImported->name);
            $variant->setProject($project);
            $variants->add($variant);
            $project->addVariant($variant);

            $this->variantRepository->save($variant, false);
        }

        foreach ($projectImported->Profil as $profilImported)
        {
            $profil = new Profil();
            $profil->setProfilOrder($profilImported->profilOrder);
            $profil->setProject($project);
            $profils->add($profil);
            $project->addProfil($profil);

            $this->profilRepository->save($profil, false);
        }

        foreach ($projectImported->Critery as $keyCr=>$criteryImported)
        {
            foreach ($projectImported->Variant as $keyVr=>$variantImported)
            {
                $variantValue = new VariantValue();
                $variantValue->setCritery($criteries[$keyCr]);
                $variantValue->setVariant($variants[$keyVr]);
                $variantValue->setValue($criteryImported->VariantValue[$keyVr]->value);
                $criteries[$keyCr]->addVariantValue($variantValue);
                $variants[$keyVr]->addVariantValue($variantValue);

                $this->variantValueRepository->save($variantValue, false);
            }

            foreach ($projectImported->Profil as $keyPr=>$profilImported)
            {
                $profilValue = new ProfilValue();
                $profilValue->setCritery($criteries[$keyCr]);
                $profilValue->setProfil($profils[$keyPr]);
                $profilValue->setValue($criteryImported->ProfilValue[$keyPr]->value);
                $criteries[$keyCr]->addProfilValue($profilValue);
                $profils[$keyPr]->addProfilValue($profilValue);

                $this->profilValueRepository->save($profilValue, false);
            }
        }

        foreach ($projectImported->Klas as $klasImported)
        {
            $klas = new Klas();
            $klas->setName($klasImported->name);
            $klas->setProject($project);
            $klas->setKlasOrder($klasImported->klasOrder);
            $project->addKlas($klas);

            $this->klasRepository->save($klas, false);
            $klases->add($klas);
        }

        $this->projectRepository->save($project, true);

        return $project;
    }
}