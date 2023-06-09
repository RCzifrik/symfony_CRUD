<?php

namespace App\Controller;

use App\Entity\Autos;
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{

    #[Route('/redirect', name: 'redirect')]
    public function redirectAction(Security $security): Response
    {
        if ($security->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('admin_home');
        }
        if ($security->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('user_home');
        }
    }

    #[Route('/user', name: 'user_home')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $cars = $doctrine->getRepository(Autos::class)->findAll();

        return $this->render('user/home.html.twig', [
            'cars' => $cars,
        ]);
    }

    #[Route('/register', name: 'register')]
    public function register(ManagerRegistry $doctrine, Request $request): Response
    {
        $entitymanager = $doctrine->getManager();
        $user = new User();

        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $entitymanager->persist($user);
            $entitymanager->flush();
            return $this->redirectToRoute('user_home');
        }

        return $this->renderForm('user/register.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils, ManagerRegistry $doctrine, Request $request): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('user/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout(): Response
    {
        return $this->redirectToRoute('home');
    }
}
