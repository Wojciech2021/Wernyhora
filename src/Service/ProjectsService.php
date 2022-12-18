<?php

namespace App\Service;

use App\Entity\Critery;
use App\Entity\Profil;
use App\Entity\ProfilValue;
use App\Entity\Project;
use App\Entity\User;
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
}