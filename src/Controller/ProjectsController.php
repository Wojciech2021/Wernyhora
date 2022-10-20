<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\Project\AddProjectType;
use App\Form\Project\EditProjectType;
use App\Form\CriteriesVariantsValuesType;
use App\Form\CireriesCollectionType;
use App\Form\VariantsCollectionType;
use App\Repository\ProjectRepository;
use App\Service\ProjectsService;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Scalar\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectsController extends AbstractController
{
    #[Route('/projects', name: 'app_manage_projects')]
    public function index(Request $request,
                          ProjectsService $projectsService): Response
    {

        $user = $this->getUser();
        $projectsService->setUser($user);
        $form = $this->createForm(AddProjectType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            $project = $form->getData();
            $projectsService->addNewProject($project);
            $form = $this->createForm(AddProjectType::class);
            // TO DO Dodaje kolejne projekty jak się odświerza stronę
        }

        $projectsArray = $projectsService->gettAllProjects();

        return $this->render('projects/index.html.twig', [
            'form' => $form->createView(),
            'projectsArray' => $projectsArray,
        ]);
    }

    #[Route('/projects/edit/{slug}', name: 'app_edit_project')]
    public function editProject(Request $request,
                                Project $project,
                                ProjectRepository $projectRepository,
                                ProjectsService $projectsService)
    {

        $form = $this->createForm(EditProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            $project = $form->getData();
            $criteriesCollection = $form['criteriesCollection']->getData();
            $variantsCollection = $form['variantsCollection']->getData();
            $variantsValuesCollection = $form['variantsValuesCollection']->getData()['variantsValues'];
            $projectsService->updateProject($project, $criteriesCollection, $variantsCollection, $variantsValuesCollection);
        }

        return $this->render('projects/edit.html.twig', [
            'form' => $form->createView(),
            'project' => $project,
        ]);
    }
}
