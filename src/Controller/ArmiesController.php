<?php

namespace App\Controller;

use App\Entity\Armies;
use App\Form\ArmiesType;
use App\Repository\ArmiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/armies')]
class ArmiesController extends AbstractController
{
    #[Route('/', name: 'armies_index', methods: ['GET'])]
    public function index(ArmiesRepository $armiesRepository): Response
    {
        return $this->render('armies/index.html.twig', [
            'armies' => $armiesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'armies_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $army = new Armies();
        $form = $this->createForm(ArmiesType::class, $army);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($army);
            $entityManager->flush();

            return $this->redirectToRoute('armies_index');
        }

        return $this->render('armies/new.html.twig', [
            'army' => $army,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'armies_show', methods: ['GET'])]
    public function show(Armies $army): Response
    {
        return $this->render('armies/show.html.twig', [
            'army' => $army,
        ]);
    }

    #[Route('/{id}/edit', name: 'armies_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Armies $army): Response
    {
        $form = $this->createForm(ArmiesType::class, $army);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('armies_index');
        }

        return $this->render('armies/edit.html.twig', [
            'army' => $army,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'armies_delete', methods: ['DELETE'])]
    public function delete(Request $request, Armies $army): Response
    {
        if ($this->isCsrfTokenValid('delete'.$army->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($army);
            $entityManager->flush();
        }

        return $this->redirectToRoute('armies_index');
    }
}
