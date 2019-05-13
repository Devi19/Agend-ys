<?php

namespace App\Controller;

use App\Entity\Horarios;
use App\Form\HorariosType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/horarios")
 */
class HorariosController extends AbstractController
{
    /**
     * @Route("/", name="horarios_index", methods={"GET"})
     */
    public function index(): Response
    {
        $horarios = $this->getDoctrine()
            ->getRepository(Horarios::class)
            ->findAll();

        return $this->render('horarios/index.html.twig', [
            'horarios' => $horarios,
        ]);
    }

    /**
     * @Route("/new", name="horarios_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $horario = new Horarios();
        $form = $this->createForm(HorariosType::class, $horario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($horario);
            $entityManager->flush();

            return $this->redirectToRoute('horarios_index');
        }

        return $this->render('horarios/new.html.twig', [
            'horario' => $horario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="horarios_show", methods={"GET"})
     */
    public function show(Horarios $horario): Response
    {
        return $this->render('horarios/show.html.twig', [
            'horario' => $horario,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="horarios_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Horarios $horario): Response
    {
        $form = $this->createForm(HorariosType::class, $horario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('horarios_index', [
                'id' => $horario->getId(),
            ]);
        }

        return $this->render('horarios/edit.html.twig', [
            'horario' => $horario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="horarios_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Horarios $horario): Response
    {
        if ($this->isCsrfTokenValid('delete'.$horario->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($horario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('horarios_index');
    }
}
