<?php

namespace App\Controller;

use App\Entity\Autos;
use App\Form\DeleteType;
use App\Form\InsertType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CrudController extends AbstractController
{
    #[Route('/details/{id}', name: 'car_details')]
    public function details(ManagerRegistry $doctrine, int $id): Response
    {

        $carDetails = $doctrine->getRepository(Autos::class)->findBy(['id' => $id]);

        return $this->render('pages/details.html.twig', [
            'cars' => $carDetails,
        ]);
    }

    #[Route('/insert', name: 'car_insert')]
    public function insert(ManagerRegistry $doctrine,Request $request): Response
    {

        $entityManager = $doctrine->getManager();

        $car = new Autos();

        $form = $this->createForm(InsertType::class, $car);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated

            $car = $form->getData();

            $entityManager->persist($car);

            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->renderForm('pages/insert.html.twig', [
            'form' => $form
        ]);
    }
    #[Route('/delete/{id}', name: 'car_delete')]
    public function delete(ManagerRegistry $doctrine,Request $request , int $id): Response
    {
        $entitymanager = $doctrine->getManager();

        $carDelete = $doctrine->getRepository(Autos::class)->find($id);

        $form = $this->createForm(DeleteType::class, $carDelete);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entitymanager->remove($carDelete);

            $entitymanager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->renderForm('pages/delete.html.twig', [
            'form' => $form
        ]);
    }
}
