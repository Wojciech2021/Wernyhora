<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\Project\AddProjectType;
use App\Form\Project\EditProjectType;
use App\Form\CriteriesVariantsValuesType;
use App\Form\CireriesCollectionType;
use App\Form\VariantsCollectionType;
use App\Service\ProjectsService;
use Doctrine\ORM\EntityManagerInterface;
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
                                ProjectsService $projectsService)
    {
        //$project = $projectsService->getProject($id);

//        $form = $this->createForm(EditProjectType::class, $project);

        $form3 = $this->createForm(CriteriesVariantsValuesType::class);
        $form3->handleRequest($request);

        //dd($form1);

//        $form->handleRequest($request);

//        if ($form->isSubmitted() && $form->isValid())
//        {
//
//            $project = $form->getData();
//            $projectsService->updateProject($project);
//        }

        if ($form3->isSubmitted() && $form3->isValid())
        {
//            ($form3->getData());
            dump('dupa');
        }

        return $this->render('projects/edit.html.twig', [
//            'form' => $form->createView(),
            'project' => $project,
//            'form1' => $form1->createView(),
//            'form2' => $form2->createView(),
            'form3' => $form3->createView(),
        ]);
    }
}
