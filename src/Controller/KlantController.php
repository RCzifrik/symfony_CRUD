<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KlantController extends AbstractController
{
    #[Route('/klant', name: 'app_klant')]
    public function index(): Response
    {
        return $this->render('klant/index.html.twig', [
            'controller_name' => 'KlantController',
        ]);
    }
}
