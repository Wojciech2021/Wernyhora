<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\CriteriesVariantsToCalculateType;
use App\Form\KlasCollectionType;
use App\Form\ProfilesValuesCollectionType;
use App\Form\Project\AddProjectType;
use App\Form\Project\EditProjectType;
use App\Form\CireriesCollectionType;
use App\Form\Project\ImportProjectType;
use App\Form\VariantsCollectionType;
use App\Form\ThresholdCollectionType;
use App\Form\VariantsValuesCollectionType;
use App\Service\ChartService;
use App\Service\ProjectsService;
use App\Service\CriteryVariantService;
use App\Service\KlasService;
use App\Service\testAndIndexService;
use App\Service\TheresholdService;
use App\Service\VariantCriteryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\HeaderUtils;

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
            $project->setCutOffLevel(1);
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
    public function raportProject(Request               $request,
                                  Project               $project,
                                  TheresholdService     $theresholdService,
                                  Session               $session,
                                  ChartService          $chartService,
                                  ChartBuilderInterface $chartBuilder,)
    {
        $criteriesCollection = $session->get('criteriesCollection');
        $variantsCollection = $session->get('variantsCollection');
        $criteries = $project->getCritery();
        $klass = $project->getKlas();
        $profiles = $project->getProfil();
        $variants = $project->getVariant();
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart = $chartService->prepareChartToRaport($chart, $profiles, $variants->toArray(), $criteries->toArray());

        $form = $this->createForm(CriteriesVariantsToCalculateType::class,
            [
                'project' => $project,
                'criteriesCollection' => $criteriesCollection,
                'variantsCollection' => $variantsCollection
            ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $criteriesCollection = $form['criteriesCollection']->getData();
            $variantsCollection = $form['variantsCollection']->getData();
            $session->set('criteriesCollection', $criteriesCollection);
            $session->set('variantsCollection', $variantsCollection);

            if ($form->getClickedButton() && 'getRaport' === $form->getClickedButton()->getName())
            {
                $form = $this->createForm(CriteriesVariantsToCalculateType::class,
                    [
                        'project' => $project,
                        'criteriesCollection' => $criteriesCollection,
                        'variantsCollection' => $variantsCollection
                    ]);

                $testAndIndexService = null;
                $testValues = null;

                if (count($criteriesCollection) >= 1 && count($variantsCollection) >= 1)
                {
                    $testAndIndexService = new testAndIndexService($project, $theresholdService, $criteriesCollection, $variantsCollection, $profiles);
                    $testValues = $testAndIndexService->getTestValues();
                }

                $chart = $chartService->prepareChartToRaport($chart, $profiles, $variantsCollection, $criteriesCollection);

                return $this->render('/projects/testValue/display.html.twig',[
                    'project' => $project,
                    'criteries' => $criteriesCollection,
                    'klas' => $klass,
                    'profiles' =>$profiles,
                    'variants' => $variantsCollection,
                    'testValues' => $testValues,
                    'form' => $form,
                    'theresholdService' => $theresholdService,
                    'chart' => $chart,
                ]);
            }

            if ($form->getClickedButton() && 'getPDFRaport' === $form->getClickedButton()->getName())
            {
                $this->addFlash('success', 'Wygenerowano raport do pliku pdf!');

                return $this->redirectToRoute('app_raport_pdf_project', [
                    'slug' => $project->getSlug(),
                    ]);
            }


        }

        $testAndIndexService = new testAndIndexService($project, $theresholdService, $criteries, $variants, $profiles);
        $testValues = $testAndIndexService->getTestValues();

        return $this->render('/projects/testValue/display.html.twig',[
            'project' => $project,
            'criteries' => $criteries,
            'klas' => $klass,
            'profiles' =>$profiles,
            'variants' => $variants,
            'testValues' => $testValues,
            'form' => $form,
            'theresholdService' => $theresholdService,
            'chart' => $chart,
        ]);
    }

    #[Route('/projects/raport/pdf/{slug}', name: 'app_raport_pdf_project')]
    public function raportPDFProject(Project               $project,
                                     TheresholdService     $theresholdService,
                                     Session               $session,
                                    VariantCriteryService $variantCriteryService)
    {
        $criteriesCollection = $session->get('criteriesCollection');
        $variantsCollection = $session->get('variantsCollection');

        $criteries = $project->getCritery();
        $klass = $project->getKlas();
        $profiles = $project->getProfil();
        $variants = $project->getVariant();

        $testAndIndexService = null;
        $testValues = null;

        if (count($criteriesCollection) >= 1 && count($variantsCollection) >=1)
        {
            $criteries = $variantCriteryService->filterVariantCritery($criteries, $criteriesCollection);
            $variants = $variantCriteryService->filterVariantCritery($variants, $variantsCollection);
            $testAndIndexService = new testAndIndexService($project, $theresholdService, $criteries, $variants, $profiles);
            $testValues = $testAndIndexService->getTestValues();
        }
        else
        {
            $testAndIndexService = new testAndIndexService($project, $theresholdService, $criteries, $variants, $profiles);
            $testValues = $testAndIndexService->getTestValues();
        }

        $html = <<<EOF
<style>

table, td, th {
  border: 1px solid;
}

table {
  width: 100%;
  border: 1px solid;
  border-collapse: collapse;
  margin-bottom: 20px;
}

body {
    font-family: DejaVu Sans;
}
.page_break { page-break-before: always; }
</style>
EOF;




        $html .= $this->renderView('/projects/pdfTemplates/display.html.twig', [
            'project' => $project,
            'criteries' => $criteries,
            'klas' => $klass,
            'profiles' =>$profiles,
            'variants' => $variants,
            'testValues' => $testValues,
            'theresholdService' => $theresholdService,
        ]);

        $options = new Options();
        $options->set('defaultFont', 'DejaVuSans');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($project->getName().".pdf");

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

    #[Route('/projects/export/{slug}', name: 'app_export_project')]
    public function exportProject(Project         $project)
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $serializer = new Serializer([$normalizer], $encoders);
        $data = $serializer->normalize($project, 'json', ['groups' => 'group1']);
        $jsonContent = $serializer->serialize($data, 'json');

        $filesystem = new Filesystem();

        try {
            $filesystem->mkdir(
                Path::normalize(sys_get_temp_dir().'/'.random_int(0, 1000)),
            );
        } catch (IOExceptionInterface $exception) {
            echo "An error occurred while creating your directory at ".$exception->getPath();
        }

        $filesystem->remove(['symlink', '', $project->getName().'.json']);
        $filesystem->appendToFile($project->getName().'.json', $jsonContent);

        $file = $project->getName().'.json';
        $response = new BinaryFileResponse($file);

        $disposition = HeaderUtils::makeDisposition(
            HeaderUtils::DISPOSITION_ATTACHMENT,
            $project->getName().'.json'
        );

        $response->headers->set('Content-Disposition', $disposition);

        return $response;
    }

    #[Route('/projects/import', name: 'app_import_project')]
    public function importProject(Request               $request,
                                  ProjectsService $projectsService)
    {
        $form = $this->createForm(ImportProjectType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $projectJson = file_get_contents($form->get('file')->getData());
            $project = json_decode($projectJson);
            $user = $this->getUser();
            $projectsService->setUser($user);
            $projectsService->importProject($project);

            return $this->redirect('/projects');
        }

        return $this->render('/projects/project_import.html.twig',[
            'form' => $form,
        ]);
    }

}
