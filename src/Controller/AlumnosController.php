<?php

namespace App\Controller;

use App\Entity\Alumnos;
use App\Form\AlumnosType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/alumnos")
 */
class AlumnosController extends AbstractController {

	
	//*******************OPERACIONES CON AMIGOS******************************
	
	/**
	 * @Route("/", name="alumnos_index", methods={"GET"})
	 */
	public function index(): Response {
		$alumno = $this->getUser();
		$amigos = $alumno->getAlumnosTarget();

		return $this->render('alumnos/index.html.twig', [
					'amigos' => $amigos,
		]);
	}

	/**
	 * @Route("/new", name="alumnos_new", methods={"GET","POST"})
	 */
	public function nuevo(Request $request): Response {
		$alumno = new Alumnos();
		$status= null;
		
		$form = $this->createForm(AlumnosType::class, $alumno);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$alumno_actual= $this->getUser();
			
			//Comprueba que el email exista
			$email = $form->get('email')->getData();
			$repo = $this->getDoctrine()->getRepository(Alumnos::class);
			$amigo = $repo->findOneBy(['email' => $email]);

			if (!$amigo) {
				$status = 'El alumno no existe';
			}elseif ($alumno_actual->getEmail() != $email) {
				$em = $this->getDoctrine()->getManager();
				$alumno_actual = $this->getUser();
				$id_amigo = $amigo->getId();
				$alumno_actual->addAlumnosTarget($amigo);
				$em->persist($alumno_actual);
				$em->flush();

				return $this->redirectToRoute('alumnos_index');
			}else{
				$status= '¡Debes escribir un email diferente al tuyo!';
			}
		}

		return $this->render('alumnos/new.html.twig', [
					'alumno' => $alumno,
					'status' => $status,
					'form' => $form->createView(),
		]);
	}
	
	/**
	 * @Route("/{id}/delete", name="alumnos_delete", methods={"GET", "POST"})
	 */
	public function delete(Request $request, Alumnos $alumno): Response {

		$em = $this->getDoctrine()->getManager();
		$alumno_actual = $this->getUser();		
		$alumno_actual->removeAlumnosTarget($alumno);
		$em->persist($alumno_actual);
		$em->flush();

		return $this->redirectToRoute('alumnos_index');
	}

	//FIN OPERACIONES AMIGOS	
	
//	
//	//****************OPERACIONES CON MATERIAS**********************
//	/**
//	 * @Route("/materias", name="alumnos_materias", methods={"GET"})
//	 */
//	public function indexMaterias(): Response {
//		$alumno = $this->getUser();
//		$amigos = $alumno->getAlumnosTarget();
//
//		return $this->render('materias/index.html.twig', [
//					'amigos' => $amigos,
//		]);
//	}

//	
//	/**
//	 * @Route("/materias/new", name="alumnos_materias_new", methods={"GET","POST"})
//	 */
//	public function nuevoMaterias(Request $request): Response {
//		$alumno = new Alumnos();
//		$status= null;
//		
//		$form = $this->createForm(AlumnosType::class, $alumno);
//		$form->handleRequest($request);
//
//		if ($form->isSubmitted() && $form->isValid()) {
//			$alumno_actual= $this->getUser();
//			
//			//Comprueba que el email exista
//			$email = $form->get('email')->getData();
//			$repo = $this->getDoctrine()->getRepository(Alumnos::class);
//			$amigo = $repo->findOneBy(['email' => $email]);
//
//			if (!$amigo) {
//				$status = 'El alumno no existe';
//			}elseif ($alumno_actual->getEmail() != $email) {
//				$em = $this->getDoctrine()->getManager();
//				$alumno_actual = $this->getUser();
//				$id_amigo = $amigo->getId();
//				$alumno_actual->addAlumnosTarget($amigo);
//				$em->persist($alumno_actual);
//				$em->flush();
//
//				return $this->redirectToRoute('alumnos_materias');
//			}else{
//				$status= '¡Debes escribir un email diferente al tuyo!';
//			}
//		}
//
//		return $this->render('materias/new.html.twig', [
//					'alumno' => $alumno,
//					'status' => $status,
//					'form' => $form->createView(),
//		]);
//	}
//	
//	/**
//	 * @Route("/{id}/materias/delete", name="alumnos_materias_delete", methods={"GET", "POST", "DELETE"})
//	 */
//	public function deleteMaterias(Request $request, Alumnos $alumno): Response {
//
//		$em = $this->getDoctrine()->getManager();
//		$alumno_actual = $this->getUser();		
//		$alumno_actual->removeAlumnosTarget($alumno);
//		$em->persist($alumno_actual);
//		$em->flush();
//
//		return $this->redirectToRoute('alumnos_materias');
//	}
	//FIN OPERACIONES MATERIAS
	
}
