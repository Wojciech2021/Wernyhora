<?php

namespace App\Controller;

use App\Form\DisplayComputerLogForms\DisplayComputerLogForm;
use App\Service\ChartService;
use App\Service\ComputerLogContainer;
use App\Service\ComputerLogService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class DisplayComputerLogController extends AbstractController
{
    #[Route('/display', name: 'app_display_computer_log')]
    #[IsGranted('ROLE_MANAGER')]
    public function index(Request $request,
                          ComputerLogService $computerLogService,
                          ComputerLogContainer $computerLogContainer,
                          ChartBuilderInterface $chartBuilder,
                          ChartService $chartService): Response
    {

        $form = $this->createForm(DisplayComputerLogForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $dateFrom = $form->get('date_from')->getData()->getTimestamp();
            $dateTo = $form->get('date_to')->getData()->getTimestamp();
            $user = $this->getUser();
            $macAddress = $user->getMacAddress();
            $data1 = $computerLogService->getJsonData();
            $data = $computerLogService->getComputerData($dateFrom, $dateTo, $macAddress);
            //dd($data['content'], $data1);
            $computerLogContainer->createComputerLogCollection($data['content']);
            $arrayOfElements = $computerLogContainer->getArrayOfElements();
            $cpu = $form->get('cpu')->getData();
            $ram = $form->get('ram')->getData();
            $freq = $form->get('freq')->getData();
            $gpu = $form->get('gpu')->getData();
            $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
            $chart = $chartService->prepareChart($cpu, $ram, $freq, $gpu, $chart, $arrayOfElements);

            return $this->render('display_computer_log/index.html.twig', [
                'form' => $form->createView(),
                'chart' => $chart,
            ]);
        }

        return $this->render('display_computer_log/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
