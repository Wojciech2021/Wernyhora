<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\KlasCollectionType;
use App\Form\ProfilesValuesCollectionType;
use App\Form\Project\AddProjectType;
use App\Form\Project\EditProjectType;
use App\Form\CireriesCollectionType;
use App\Form\VariantsCollectionType;
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
use Knp\Snappy\Pdf;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;

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

    #[Route('/projects/edit/{slug}', name: 'app_edit_project')]
    public function editProject(Request               $request,
                                       Project               $project,
                                       ProjectsService $projectsService)
    {

        $form = $this->createForm(EditProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $project = $form->getData();
            $projectsService->updateProject($project);

            $this->addFlash('success', 'Zapisano poziom odcięcia!');

            return $this->redirectToRoute('app_edit_critery_project', ['slug' => $project->getSlug()]);
        }

        return $this->render('projects/project/edit.html.twig', [
            'form' => $form->createView(),
            'project' => $project,
        ]);
    }

    #[Route('/projects/edit/critery/{slug}', name: 'app_edit_critery_project')]
    public function editCritery(Request               $request,
                                       Project               $project,
                                       CriteryVariantService $criteryVariantService)
    {

        $form = $this->createForm(CireriesCollectionType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $criteriesCollection = $form['criteries']->getData();

            $criteryVariantService->updateCritery($project, $criteriesCollection);

            $this->addFlash('success', 'Zapisano kryteria!');

            return $this->redirectToRoute('app_edit_variant_project', ['slug' => $project->getSlug()]);
        }

        return $this->render('/projects/critery/edit.html.twig',[
            'form' => $form->createView(),
            'project' => $project,
        ]);
    }

    #[Route('/projects/edit/variant/{slug}', name: 'app_edit_variant_project')]
    public function editVariant(Request               $request,
                                Project               $project,
                                CriteryVariantService $criteryVariantService)
    {

        $form = $this->createForm(VariantsCollectionType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $variantsCollection = $form['variants']->getData();
            $criteriesCollection = $project->getCritery();
            $criteryVariantService->updateVariant($project, $variantsCollection);

            $variantsCollection = $project->getVariant();
            $criteryVariantService->updateCriteriesVariants($project, $criteriesCollection, $variantsCollection);

            $this->addFlash('success', 'Zapisano warianty!');

            return $this->redirectToRoute('app_edit_variants_values_project', ['slug' => $project->getSlug()]);
        }

        return $this->render('/projects/variant/edit.html.twig',[
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
        $variants = $project->getVariant();
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
//        $testAndIndexService = new testAndIndexService($project, $theresholdService);
        $testValues = null;

        $form = $this->createForm(ThresholdCollectionType::class, $criteries);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            if ($form->getClickedButton() && 'addThreshold' === $form->getClickedButton()->getName())
            {
                $criteriesOnChart = $form['criteriesCollection']->getData();
                $thresholdOnChart = $form['thresholdTypes']->getData();
                $criteryVariantService->updateCriteries($project, $criteries);
                $this->addFlash('success', 'Zapisano wartości progów!');
                $chart = $chartService->prepareChart($chart, $profiles, $theresholdService, $criteriesOnChart, $thresholdOnChart);
            }

            if ($form->getClickedButton() && 'raport' === $form->getClickedButton()->getName())
            {
                $this->addFlash('success', 'Wygenerowano raport!');
                return $this->redirectToRoute('app_raport_project', ['slug' => $project->getSlug()]);
            }

        }

        return $this->render('/projects/thresholdValue/edit.html.twig',[
            'form' => $form->createView(),
            'project' => $project,
            'criteries' => $criteries,
            'klas' => $klass,
            'profiles' =>$profiles,
            'chart' => $chart,
            'theresholdService' => $theresholdService,
            'testValues' => $testValues,
            'variants' => $variants,
        ]);
    }

    #[Route('/projects/raport/{slug}', name: 'app_raport_project')]
    public function raportProject(Project               $project,
                                  TheresholdService     $theresholdService)
    {
        $criteries = $project->getCritery();
        $klass = $project->getKlas();
        $profiles = $project->getProfil();
        $variants = $project->getVariant();
        $testAndIndexService = new testAndIndexService($project, $theresholdService, $criteries, $variants, $profiles);
        $testValues = $testAndIndexService->getTestValues();
//        dd($testValues);


        return $this->render('/projects/testValue/display.html.twig',[
            'project' => $project,
            'criteries' => $criteries,
            'klas' => $klass,
            'profiles' =>$profiles,
            'variants' => $variants,
            'testValues' => $testValues,
        ]);
    }

    #[Route('/projects/raport/pdf/{slug}', name: 'app_raport_pdf_project')]
    public function raportPDFProject(Project               $project,
                                  TheresholdService     $theresholdService,
                                        Pdf $pdf)
    {

        $testAndIndexService = new testAndIndexService($project, $theresholdService);
        $testValues = $testAndIndexService->getTestValues();

        $criteries = $project->getCritery();
        $klass = $project->getKlas();
        $profiles = $project->getProfil();
        $variants = $project->getVariant();

        $html = $this->renderView('/projects/testValue/display.html.twig', [
            'project' => $project,
            'criteries' => $criteries,
            'klas' => $klass,
            'profiles' =>$profiles,
            'variants' => $variants,
            'testValues' => $testValues,
        ]);


//        $pdf->getOutputFromHtml();

        return new PdfResponse(
            $pdf->getOutputFromHtml($html),
            'file.pdf'
        );
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
