<?php

namespace App\Controller;

use App\Entity\Autos;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ManagerRegistry $doctrine): Response
    {

        $cars = $doctrine->getRepository(Autos::class)->findAll();

        return $this->render('pages/home.html.twig', [
            'cars' => $cars,
        ]);
    }
}
