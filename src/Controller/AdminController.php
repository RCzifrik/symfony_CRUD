<?php

namespace App\Controller;

use App\Entity\Autos;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin/', name: 'admin_home')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $cars = $doctrine->getRepository(Autos::class)->findAll();

        return $this->render('admin/home.html.twig', [
            'cars' => $cars,
        ]);
    }
}
