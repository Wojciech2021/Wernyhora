<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\KlasCollectionType;
use App\Form\ProfilesValuesCollectionType;
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

            return $this->redirectToRoute('app_edit_klas_project', ['slug' => $project->getSlug()]);
        }

        return $this->render('/projects/variantValue/edit.html.twig',[
            'form' => $form->createView(),
            'project' => $project,
            'criteries' => $criteries,
            'variants' => $variants,
        ]);
    }

    #[Route('/projects/edit/klas/{slug}', name: 'app_edit_klas_project')]
    public function editKlas(Request $request,
                                Project $project,
                                ProjectsService $projectsService)
    {

        $form = $this->createForm(KlasCollectionType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            $klasCollection = $form['klas']->getData();

            $projectsService->updateKlas($project, $klasCollection);

            return $this->redirectToRoute('app_edit_profils_values_project', ['slug' => $project->getSlug()]);
        }

        return $this->render('/projects/klas/edit.html.twig',[
            'form' => $form->createView(),
            'project' => $project,
        ]);
    }

    #[Route('/projects/edit/profils_values/{slug}', name: 'app_edit_profils_values_project')]
    public function editProfilValue(Request $request,
                                  Project $project,
                                  ProjectsService $projectsService)
    {


        $klassCollection = $project->getKlas();
        $projectsService->addProfiles($project, $klassCollection);

        $criteries = $project->getCritery();
        $profiles = $project->getProfil();

        $form = $this->createForm(ProfilesValuesCollectionType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            dd($form['profilesValues']->getData());
//            $projectsService->updateProfilesValues($project, );
//            $klasCollection = $form['klas']->getData();
//
//            $projectsService->updateKlas($project, $klasCollection);
        }

        return $this->render('/projects/profilValue/edit.html.twig',[
            'form' => $form->createView(),
            'project' => $project,
            'criteries' => $criteries,
            'profiles' => $profiles,
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
