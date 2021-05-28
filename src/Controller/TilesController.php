<?php

namespace App\Controller;

use App\Entity\Tiles;
use App\Form\TilesType;
use App\Repository\TilesRepository;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/tiles')]
class TilesController extends AbstractController
{
    #[Route('/', name: 'tiles_index', methods: ['GET'])]
    public function index(TilesRepository $tilesRepository): Response
    {
        return $this->render('tiles/index.html.twig', [
            'tiles' => $tilesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'tiles_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $tile = new Tiles();
        $form = $this->createForm(TilesType::class, $tile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tile);
            $entityManager->flush();

            return $this->redirectToRoute('tiles_index');
        }

        return $this->render('tiles/new.html.twig', [
            'tile' => $tile,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'tiles_show', methods: ['GET'])]
    public function show(Tiles $tile): Response
    {
        return $this->render('tiles/show.html.twig', [
            'tile' => $tile,
        ]);
    }

    #[Route('/{id}/load', name: 'tiles_load', methods: ['GET'])]
    public function load(int $id): JsonResponse
    {
        $tuile = $this->getDoctrine()
            ->getRepository(Tiles::class)
            ->find($id);

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        
        $serializer = new Serializer($normalizers, $encoders);

        $jsonContent = $serializer->serialize($tuile, 'json');

        return $this->json($jsonContent);
    }

    #[Route('/{id}/edit', name: 'tiles_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tiles $tile): Response
    {
        $form = $this->createForm(TilesType::class, $tile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tiles_index');
        }

        return $this->render('tiles/edit.html.twig', [
            'tile' => $tile,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'tiles_delete', methods: ['DELETE'])]
    public function delete(Request $request, Tiles $tile): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tile->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tile);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tiles_index');
    }
}
