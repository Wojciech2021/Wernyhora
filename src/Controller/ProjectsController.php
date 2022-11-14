<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\KlasNameCollectionType;
use App\Form\Project\AddProjectType;
use App\Form\Project\EditProjectType;
use App\Form\VariantsValuesCollectionType;
use App\Service\ProjectsService;
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

    #[Route('/projects/edit/critery_variant/{slug}', name: 'app_edit_critery_variant_project')]
    public function editCritery(Request $request,
                                Project $project,
                                ProjectsService $projectsService)
    {

        $form = $this->createForm(EditProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            $criteriesCollection = $form['criteriesCollection']['criteries']->getData();
            $variantsCollection = $form['variantsCollection']['variants']->getData();
            $project = $form->getData();
            $projectsService->updateCriteriesVariants($project, $criteriesCollection, $variantsCollection);

            return $this->redirectToRoute('app_edit_variants_values_project', ['slug' => $project->getSlug()]);
        }

        return $this->render('projects/criteryVariant/edit.html.twig', [
            'form' => $form->createView(),
            'project' => $project,
        ]);
    }

    #[Route('/projects/edit/variants_values/{slug}', name: 'app_edit_variants_values_project')]
    public function editVariant(Request $request,
                                Project $project,
                                ProjectsService $projectsService)
    {

        $criteries = $project->getCritery();
        $variants = $project->getVariant();

        $form = $this->createForm(VariantsValuesCollectionType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            $variantsValuesCollection = $form['variantsValues']->getData();

            $projectsService->updateVariantsValues($project, $variantsValuesCollection);

            return $this->redirectToRoute('app_edit_klas_name_project', ['slug' => $project->getSlug()]);
        }

        return $this->render('/projects/variantValue/edit.html.twig',[
            'form' => $form->createView(),
            'project' => $project,
            'criteries' => $criteries,
            'variants' => $variants,
        ]);
    }

    #[Route('/projects/edit/klas_name/{slug}', name: 'app_edit_klas_name_project')]
    public function editClassName(Request $request,
                                Project $project,
                                ProjectsService $projectsService)
    {

        $form = $this->createForm(KlasNameCollectionType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            dd($form['klassNames']->getData());
            $klasNamesCollection = $form['klassNames']->getData();

            $projectsService->updateKlasNames($project, $klasNamesCollection);
        }

        return $this->render('/projects/klasName/edit.html.twig',[
            'form' => $form->createView(),
            'project' => $project,
        ]);
    }

    #[Route('/projects/delete/{slug}', name: 'app_delete_project')]
    public function deleteProject(Project $project,
                                ProjectsService $projectsService)
    {
        $user = $this->getUser();
        $projectsService->setUser($user);
        $projectsService->deleteProject($project);

        return $this->redirect('/projects');
    }

}
