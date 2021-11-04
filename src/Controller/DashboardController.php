<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'requests' => rand(100,1000),
            "users"=> rand(100,1000),
            "teams"=> rand(100,1000)
        ]);
    }
}
