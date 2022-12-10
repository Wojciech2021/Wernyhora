<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\KlasCollectionType;
use App\Form\ProfilesValuesCollectionType;
use App\Form\Project\AddProjectType;
use App\Form\Project\EditProjectType;
use App\Form\ThresholdCollectionType;
use App\Form\VariantsValuesCollectionType;
use App\Service\ChartService;
use App\Service\ProjectsService;
use App\Service\CriteryVariantService;
use App\Service\KlasService;
use App\Service\testAndIndexService;
use App\Service\TheresholdService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

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
            $this->addFlash('success', 'Dodano projekt '.$project->getName());
            // TO DO Dodaje kolejne projekty jak się odświerza stronę
        }

        $projectsArray = $projectsService->gettAllProjects();

        return $this->render('projects/index.html.twig', [
            'form' => $form->createView(),
            'projectsArray' => $projectsArray,
        ]);
    }

    #[Route('/projects/edit/critery_variant/{slug}', name: 'app_edit_critery_variant_project')]
    public function editCriteryVariant(Request               $request,
                                       Project               $project,
                                       CriteryVariantService $criteryVariantService)
    {

        $form = $this->createForm(EditProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            $criteriesCollection = $form['criteriesCollection']['criteries']->getData();
            $variantsCollection = $form['variantsCollection']['variants']->getData();
            $project = $form->getData();
            $criteryVariantService->updateCriteriesVariants($project, $criteriesCollection, $variantsCollection);

            $this->addFlash('success', 'Zapisano kryteria i warianty');

            return $this->redirectToRoute('app_edit_variants_values_project', ['slug' => $project->getSlug()]);
        }

        return $this->render('projects/criteryVariant/edit.html.twig', [
            'form' => $form->createView(),
            'project' => $project,
        ]);
    }

    #[Route('/projects/edit/variants_values/{slug}', name: 'app_edit_variants_values_project')]
    public function editVariantValue(Request               $request,
                                Project               $project,
                                CriteryVariantService $criteryVariantService)
    {

        $criteries = $project->getCritery();
        $variants = $project->getVariant();

        $form = $this->createForm(VariantsValuesCollectionType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            $variantsValuesCollection = $form['variantsValues']->getData();

            $criteryVariantService->updateVariantsValues($project, $variantsValuesCollection);

            $this->addFlash('success', 'Zapisano wartości wariantów!');

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
    public function editKlas(Request     $request,
                             Project     $project,
                             KlasService $klasService)
    {

        $form = $this->createForm(KlasCollectionType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            $klasCollection = $form['klas']->getData();

            $klasService->updateKlas($project, $klasCollection);

            $this->addFlash('success', 'Zapisano klasy!');

            return $this->redirectToRoute('app_edit_profils_values_project', ['slug' => $project->getSlug()]);
        }

        return $this->render('/projects/klas/edit.html.twig',[
            'form' => $form->createView(),
            'project' => $project,
        ]);
    }

    #[Route('/projects/edit/profils_values/{slug}', name: 'app_edit_profils_values_project')]
    public function editProfilValue(Request     $request,
                                    Project     $project,
                                    KlasService $klasService)
    {

        $klass = $project->getKlas();
        $klasService->addProfiles($project, $klass);

        $criteries = $project->getCritery();
        $profiles = $project->getProfil();

        $form = $this->createForm(ProfilesValuesCollectionType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            $profilesValues = $form['profilesValues']->getData();
            $klasService->updateProfilesValues($project, $profilesValues);

            $this->addFlash('success', 'Zapisano wartości profili!');

            return $this->redirectToRoute('app_edit_threshold_values_project', ['slug' => $project->getSlug()]);
        }

        return $this->render('/projects/profilValue/edit.html.twig',[
            'form' => $form->createView(),
            'project' => $project,
            'criteries' => $criteries,
            'profiles' => $profiles,
        ]);
    }

    #[Route('/projects/edit/threshold_values/{slug}', name: 'app_edit_threshold_values_project')]
    public function editThresholdValue(Request               $request,
                                       Project               $project,
                                       ChartBuilderInterface $chartBuilder,
                                       CriteryVariantService $criteryVariantService,
                                       ChartService          $chartService,
                                       TheresholdService     $theresholdService)
    {

        $criteries = $project->getCritery();
        $klass = $project->getKlas();
        $profiles = $project->getProfil();
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
        $testAndIndexService = new testAndIndexService($project, $theresholdService);

        $form = $this->createForm(ThresholdCollectionType::class, $criteries);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $criteriesOnChart = $form['criteriesCollection']->getData();
            $thresholdOnChart = $form['thresholdTypes']->getData();

            $criteryVariantService->updateCriteries($project, $criteries);

            $this->addFlash('success', 'Zapisano wartości progów!');

            dd($testAndIndexService->getTestIndex());
//            $testAndIndexService->getTestIndex();


            $chart = $chartService->prepareChart($chart, $profiles, $theresholdService, $criteriesOnChart, $thresholdOnChart);
        }

        return $this->render('/projects/thresholdValue/edit.html.twig',[
            'form' => $form->createView(),
            'project' => $project,
            'criteries' => $criteries,
            'klas' => $klass,
            'profiles' =>$profiles,
            'chart' => $chart,
            'theresholdService' => $theresholdService,
        ]);
    }

    #[Route('/projects/delete/{slug}', name: 'app_delete_project')]
    public function deleteProject(Project         $project,
                                  ProjectsService $projectsService)
    {
        $this->addFlash('success', 'Usunięto projekt '.$project->getName());
        $user = $this->getUser();
        $projectsService->setUser($user);
        $projectsService->deleteProject($project);

        return $this->redirect('/projects');
    }

}
