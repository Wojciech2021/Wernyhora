<?php

namespace App\Service;

use App\Entity\Project;
use App\Entity\User;
use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;

class ProjectsService
{

    private $projectRepository;
    private $user;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
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

    public function updateProject(Project $project)
    {
        $now = new \DateTime();
        $project->setUpdateTime($now);
        $this->projectRepository->save($project, true);
    }
}