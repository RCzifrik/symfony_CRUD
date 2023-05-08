<?php

namespace App\Controller;

use App\Entity\Autos;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ManagerRegistry $doctrine, Security $security): Response
    {
        $cars = $doctrine->getRepository(Autos::class)->findAll();

        if ($security->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('admin_home');
        }
        if ($security->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('user_home');
        }

        return $this->render('pages/home.html.twig', [
            'cars' => $cars,
        ]);
    }
}
