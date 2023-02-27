<?php

namespace App\Controller\Admin;

use App\Entity\Evaluation;
use App\Entity\EvaluationSkill;
use App\Entity\Skill;
use App\Entity\Theme;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/adminDashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Skillto back-office')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Analyse des données');
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToRoute('app_main');
        yield MenuItem::section('Gestion des données');
        yield MenuItem::linkToCrud('Thèmes', 'fa-solid fa-database', Theme::class);
        yield MenuItem::linkToCrud('Skills', 'fa-solid fa-database', Skill::class);
        yield MenuItem::section('Gestion des données (Dev)');
        yield MenuItem::linkToCrud('EvaluationSkill', 'fa-solid fa-database', EvaluationSkill::class);
        yield MenuItem::linkToCrud('Evaluation', 'fa-solid fa-database', Evaluation::class);
        yield MenuItem::linkToCrud('User', 'fa-solid fa-database', User::class);
    }
}