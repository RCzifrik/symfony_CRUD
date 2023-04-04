<?php

namespace App\Controller;

use App\Entity\Autos;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CrudController extends AbstractController
{
    #[Route('/details/{id}', name: 'car_details')]
    public function index(ManagerRegistry $doctrine, int $id): Response
    {

        $carDetails = $doctrine->getRepository(Autos::class)->findBy(['id' => $id]);

        return $this->render('pages/details.html.twig', [
            'cars' => $carDetails,
        ]);
    }
}
