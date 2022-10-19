<?php

namespace App\Service;

use App\Entity\Critery;
use App\Entity\Project;
use App\Entity\User;
use App\Repository\CriteryRepository;
use App\Repository\ProjectRepository;
use App\Repository\VariantRepository;
use App\Repository\VariantValueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;

class ProjectsService
{

    private $projectRepository;
    private $criteryRepository;
    private $variantRepository;
    private $variantValueRepository;
    private $user;

    public function __construct(ProjectRepository $projectRepository,
                                CriteryRepository $criteryRepository,
                                VariantRepository $variantRepository,
                                VariantValueRepository $variantValueRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->criteryRepository =$criteryRepository;
        $this->variantRepository = $variantRepository;
        $this->variantValueRepository = $variantValueRepository;
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
            $projectsArray = $this->projectRepository->findBy(['User'=> $this->user]);

            return $projectsArray;
        }
        else
        {
            return null;
        }
    }

    public function getProject(int $id)
    {
        return $this->projectRepository->find($id);
    }

    public function updateProject(Project $project,
                                  ArrayCollection $criteries,
                                  ArrayCollection $variants,
                                  ArrayCollection $variantsValues)
    {

        foreach ($criteries as $critery)
        {

            $critery->setProject($project);
            $this->criteryRepository->save($critery, false);
            $project->addCritery($critery);

            foreach ($variants as $variant)
            {
                $variant->setProject($project);
                $this->variantRepository->save($variant, false);
                $project->addVariant($variant);
            }
        }

        $now = new \DateTime();
        $project->setUpdateTime($now);
        $this->projectRepository->save($project, true);
    }
}