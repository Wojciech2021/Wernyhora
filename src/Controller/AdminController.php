<?php

namespace App\Controller;

use App\Form\AdminForms\AddDepartmentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Service\UsersService;
use App\Form\AdminForms\AssignRolesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class AdminController extends AbstractController
{

    #[Route('/admin', name: 'app_admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {


        return $this->render('admin/index.html.twig', [
        ]);
    }

    #[Route('/admin/users', name: 'app_admin_users')]
    #[IsGranted('ROLE_ADMIN')]
    public function users(UsersService $usersService): Response
    {
        $users = $usersService->getAllUsers();

        return $this->render('admin/admin_users.html.twig', [
            'controller_name' => 'AdminController',
            'users' => $users
        ]);
    }

    #[Route('/admin/users/{id}', name: 'app_admin_users_assign_roles')]
    #[IsGranted('ROLE_ADMIN')]
    public function users_assign_roles(UsersService $usersService,int $id, Request $request): Response
    {
        $user = $usersService->getUser($id);

        $form = $this->createForm(AssignRolesType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $role = $form->getData('roles')['roles'];
            $usersService->assignRoleToUser($user, $role);
        }

        return $this->render('admin/admin_assign_role.html.twig', [
            'controller_name' => 'AdminController',
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/chart', name: 'app_chart')]
    #[IsGranted('ROLE_ADMIN')]
    public function chart(ChartBuilderInterface $chartBuilder): Response
    {
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);

        $chart->setData([
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(75, 192, 192)',
                    'data' => [65, 59, 80, 81, 56, 55, 40],
                    'borderWidth' => 10,
                    'tension' => 0.1,
                    'fill' => false,
                ],
            ],
        ]);

        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => 'Overlord',
                ],
                'annotation' => [
                    'annotations' => [
                        'box1' => [
                            'type' => 'box',
                            'xMin' => 1,
                            'xMax' => 2,
                            'yMin' => 10,
                            'yMax' => 70,
                            'backgroundColor' => 'rgba(75, 192, 192, 0.25)',
                            'label' => [
                              'content' => 'Okrągły kwadrat',
                                'enabled' => true
                            ],
                        ]
                    ]
                ]
            ],

        ]);


        return $this->render('admin/chart.html.twig', [
            'chart' => $chart,
        ]);
    }
}
