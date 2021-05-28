<?php

namespace App\Controller;

use App\Entity\Maps;
use App\Entity\Tiles;
use App\Form\MapsType;
use App\Form\TilesType;
use App\Repository\MapsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/maps')]
class MapsController extends AbstractController
{
    #[Route('/', name: 'maps_index', methods: ['GET'])]
    public function index(MapsRepository $mapsRepository): Response
    {
        return $this->render('maps/index.html.twig', [
            'maps' => $mapsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'maps_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $map = new Maps();
        $form = $this->createForm(MapsType::class, $map);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($map);
            $entityManager->flush();

            return $this->redirectToRoute('maps_index');
        }

        return $this->render('maps/new.html.twig', [
            'map' => $map,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'maps_show', methods: ['GET'])]
    public function show(Maps $map): Response
    {

        //$form = $this->createForm(TilesType::class, $tile);
        //$form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $this->getDoctrine()->getManager()->flush();

        //     return $this->redirectToRoute('tiles_index');
        // }

        return $this->render('maps/show.html.twig', [
            'map' => $map,
            // 'tile' => $tile,
            // 'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'maps_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Maps $map): Response
    {
        $form = $this->createForm(MapsType::class, $map);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('maps_index');
        }

        return $this->render('maps/edit.html.twig', [
            'map' => $map,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'maps_delete', methods: ['DELETE'])]
    public function delete(Request $request, Maps $map): Response
    {
        if ($this->isCsrfTokenValid('delete'.$map->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($map);
            $entityManager->flush();
        }

        return $this->redirectToRoute('maps_index');
    }
}
