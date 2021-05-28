<?php

namespace App\Controller;

use App\Entity\WarhammerArmies;
use App\Form\WarhammerArmiesType;
use App\Repository\WarhammerArmiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/warhammer/armies')]
class WarhammerArmiesController extends AbstractController
{
    #[Route('/', name: 'warhammer_armies_index', methods: ['GET'])]
    public function index(WarhammerArmiesRepository $warhammerArmiesRepository): Response
    {
        return $this->render('warhammer_armies/index.html.twig', [
            'warhammer_armies' => $warhammerArmiesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'warhammer_armies_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $warhammerArmy = new WarhammerArmies();
        $form = $this->createForm(WarhammerArmiesType::class, $warhammerArmy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($warhammerArmy);
            $entityManager->flush();

            return $this->redirectToRoute('warhammer_armies_index');
        }

        return $this->render('warhammer_armies/new.html.twig', [
            'warhammer_army' => $warhammerArmy,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'warhammer_armies_show', methods: ['GET'])]
    public function show(WarhammerArmies $warhammerArmy): Response
    {
        return $this->render('warhammer_armies/show.html.twig', [
            'warhammer_army' => $warhammerArmy,
        ]);
    }

    #[Route('/{id}/edit', name: 'warhammer_armies_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, WarhammerArmies $warhammerArmy): Response
    {
        $form = $this->createForm(WarhammerArmiesType::class, $warhammerArmy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('warhammer_armies_index');
        }

        return $this->render('warhammer_armies/edit.html.twig', [
            'warhammer_army' => $warhammerArmy,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'warhammer_armies_delete', methods: ['DELETE'])]
    public function delete(Request $request, WarhammerArmies $warhammerArmy): Response
    {
        if ($this->isCsrfTokenValid('delete'.$warhammerArmy->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($warhammerArmy);
            $entityManager->flush();
        }

        return $this->redirectToRoute('warhammer_armies_index');
    }
}
