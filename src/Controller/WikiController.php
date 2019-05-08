<?php

namespace App\Controller;

use App\Entity\Wiki;
use App\Form\WikiType;
use App\Repository\WikiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/wiki")
 */
class WikiController extends AbstractController
{
    /**
     * @Route("/", name="wiki_index", methods={"GET"})
     */
    public function index(WikiRepository $wikiRepository): Response
    {
        return $this->render('wiki/index.html.twig', [
            'wikis' => $wikiRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="wiki_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $wiki = new Wiki();
        $form = $this->createForm(WikiType::class, $wiki);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($wiki);
            $entityManager->flush();

            return $this->redirectToRoute('wiki_index');
        }

        return $this->render('wiki/new.html.twig', [
            'wiki' => $wiki,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="wiki_show", methods={"GET"})
     */
    public function show(Wiki $wiki): Response
    {
        return $this->render('wiki/show.html.twig', [
            'wiki' => $wiki,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="wiki_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Wiki $wiki): Response
    {
        $form = $this->createForm(WikiType::class, $wiki);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('wiki_index', [
                'id' => $wiki->getId(),
            ]);
        }

        return $this->render('wiki/edit.html.twig', [
            'wiki' => $wiki,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="wiki_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Wiki $wiki): Response
    {
        if ($this->isCsrfTokenValid('delete'.$wiki->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($wiki);
            $entityManager->flush();
        }

        return $this->redirectToRoute('wiki_index');
    }
}
