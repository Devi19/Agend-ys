<?php

namespace App\Controller;

use App\Entity\Materias;
use App\Form\MateriasType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/materias")
 */
class MateriasController extends AbstractController
{
    /**
     * @Route("/", name="materias_index", methods={"GET"})
     */
    public function index(): Response
    {
        $materias = $this->getDoctrine()
            ->getRepository(Materias::class)
            ->findAll();

        return $this->render('materias/index.html.twig', [
            'materias' => $materias,
        ]);
    }

    /**
     * @Route("/new", name="materias_new", methods={"GET","POST"})
     */
    public function nuevo(Request $request): Response
    {
        $materia = new Materias();
        $form = $this->createForm(MateriasType::class, $materia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($materia);
            $entityManager->flush();            

            return $this->redirectToRoute('materias_new');
        }

        return $this->render('materias/new.html.twig', [
            'materia' => $materia,
            'form' => $form->createView(),
        ]);
    }

    
    /**
     * @Route("/{id}/edit", name="materias_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Materias $materia): Response
    {
        $form = $this->createForm(MateriasType::class, $materia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('materias_index', [
                'id' => $materia->getId(),
            ]);
        }

        return $this->render('materias/edit.html.twig', [
            'materia' => $materia,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="materias_delete", methods={"GET", "POST", "DELETE"})
     */
    public function delete(Request $request, Materias $materia): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($materia);
        $entityManager->flush(); 

        return $this->redirectToRoute('materias_index');
    }
}
