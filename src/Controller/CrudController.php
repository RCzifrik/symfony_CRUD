<?php

namespace App\Controller;

use App\Entity\Autos;
use App\Form\DeleteType;
use App\Form\InsertType;
use App\Form\UpdateType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
    public function insert(ManagerRegistry $doctrine,Request $request, ValidatorInterface $validator): Response
    {
        $entityManager = $doctrine->getManager();
        $car = new Autos();

        $errors = $validator->validate($car);

        $form = $this->createForm(InsertType::class, $car);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();
            $entityManager->persist($car);
            $entityManager->flush();
            $this->addFlash('success', 'Insert successvol!');
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
        $car = $doctrine->getRepository(Autos::class)->find($id);
        $form = $this->createForm(DeleteType::class, $car);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entitymanager->remove($car);
            $entitymanager->flush();
            $this->addFlash('success', 'Delete successvol!');
            return $this->redirectToRoute('app_home');
        }

        return $this->renderForm('pages/delete.html.twig', [
            'form' => $form
        ]);
    }
    #[Route('/update/{id}', name: 'car_update')]
    public function update(ManagerRegistry $doctrine, Request $request, int $id): Response
    {
        $notification = "";
        $entitymanager = $doctrine->getManager();
        $car = $doctrine->getRepository(Autos::class)->find($id);
        $form = $this->createForm(UpdateType::class, $car);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entitymanager->flush();
            $this->addFlash('success', 'Update successvol!');
            return $this->redirectToRoute('car_details', [
                'id' => $car->getId()
            ]);
        }
        return $this->renderForm('pages/update.html.twig', [
            'form' => $form,
            'notification' => $notification
        ]);
    }
}
