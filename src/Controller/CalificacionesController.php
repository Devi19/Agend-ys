<?php

namespace App\Controller;

use App\Entity\Calificaciones;
use App\Form\CalificacionesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/calificaciones")
 */
class CalificacionesController extends AbstractController
{
    /**
     * @Route("/", name="calificaciones_index", methods={"GET"})
     */
    public function index(): Response
    {
        $calificaciones = $this->getDoctrine()
            ->getRepository(Calificaciones::class)
            ->findAll();

        return $this->render('calificaciones/index.html.twig', [
            'calificaciones' => $calificaciones,
        ]);
    }

    /**
     * @Route("/new", name="calificaciones_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $calificacione = new Calificaciones();
        $form = $this->createForm(CalificacionesType::class, $calificacione);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($calificacione);
            $entityManager->flush();

            return $this->redirectToRoute('calificaciones_index');
        }

        return $this->render('calificaciones/new.html.twig', [
            'calificacione' => $calificacione,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idAlumno}", name="calificaciones_show", methods={"GET"})
     * @ParamConverter("Calificaciones", options={"id" = "idAlumno"})
     */
    public function show(Calificaciones $calificacione): Response
    {
        dump($calificacione);die;
        return $this->render('calificaciones/show.html.twig', [
            'calificacione' => $calificacione,
        ]);
    }

    /**
     * @Route("/{idAlumno}/edit", name="calificaciones_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Calificaciones $calificacione): Response
    {
        $form = $this->createForm(CalificacionesType::class, $calificacione);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('calificaciones_index', [
                'idAlumno' => $calificacione->getIdAlumno(),
            ]);
        }

        return $this->render('calificaciones/edit.html.twig', [
            'calificacione' => $calificacione,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idAlumno}", name="calificaciones_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Calificaciones $calificacione): Response
    {
        if ($this->isCsrfTokenValid('delete'.$calificacione->getIdAlumno(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($calificacione);
            $entityManager->flush();
        }

        return $this->redirectToRoute('calificaciones_index');
    }
}
