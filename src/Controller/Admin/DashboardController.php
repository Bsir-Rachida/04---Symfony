<?php

namespace App\Controller\Admin;

use App\Entity\Episode;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Program;
use App\Entity\Season;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response

    {
        $program = $this->getDoctrine()->getRepository(Program::class)->count([]);
        $episode = $this->getDoctrine()->getRepository(Episode::class)->count([]);
        $season = $this->getDoctrine()->getRepository(Season::class)->count([]);
 
        return $this->render('bundles//EasyAdminBundle/welcome.html.twig', [
            'program' => $program,
            'episode' => $episode,
            'season' => $season,
        ]);
        
    }
    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('css/admin.css');
    } 
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Wild Series');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Acceuil', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linkToCrud('Séries', 'fas fa-folder-open', Program::class);
        yield MenuItem::linkToCrud('Episodes ', 'fas fa-folder-open', Episode::class);
        yield MenuItem::linkToCrud('Saisons ','fas fa-folder-open', Season::class);
    }
}
