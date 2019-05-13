<?php

namespace App\Controller;

use App\Entity\Calificaciones;
use App\Entity\Ciclos;
use App\Entity\Materias;
use App\Form\CalificacionesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

/**
 * @Route("/calificaciones")
 */
class CalificacionesController extends AbstractController {

	/**
	 * @Route("/", name="calificaciones_index", methods={"GET"})
	 */
	public function index(): Response {
		$id_alumno = $this->getUser()->getId();

		$em = $this->getDoctrine()->getManager();
		$conn = $em->getConnection();
		$sql = ' SELECT m.nombre, ci.tipo, c.nota, c.id_alumno
					FROM calificaciones c, materias m, ciclos ci
					WHERE c.id_alumno= :id_alumno 
                    AND c.id_materia= m.id 
                    AND c.id_ciclo= ci.id 	
					ORDER BY m.nombre ASC 
                ';

		$stmt = $conn->prepare($sql);
		$stmt->execute(['id_alumno' => $id_alumno]);
		$calificaciones = $stmt->fetchAll();

		return $this->render('calificaciones/index.html.twig', [
					'calificaciones' => $calificaciones,
		]);
	}

	/**
	 * @Route("/new", name="calificaciones_new", methods={"GET","POST"})
	 */
	public function nuevo(Request $request): Response {
		$calificacione = new Calificaciones();
		$alumno = $this->getUser();
		//$materias = $alumno->getMaterias();
//		dump($alumno->getId());
//		die();
//		$em = $this->getDoctrine()->getManager();
//		$conn = $em->getConnection();
//		
//		$sql = ' SELECT m.nombre
//				 FROM materias m, materias_alumnos ma		
//				 WHERE ma.alumnos_id= :id_alumno
//				 AND ma.materias_id= m.id 
//				 ORDER BY m.nombre ASC 
//                ';
//
//		$stmt = $conn->prepare($sql);
//		$stmt->execute(['id_alumno' => $id_alumno]);		
//		$materias = $stmt->fetchAll();
//		$ciclos= new Ciclos();
		//$ciclos_tipos= $calificacione->getIdCiclo();
//		dump($materias);
//		dump($materias);
//		die();
//
//		$form = $this->createFormBuilder($calificacione)
//				->add('idMateria', ChoiceType::class, [$materias])
//				->add('nota', TextType::class)
//				->add('Guardar', SubmitType::class)
//				->getForm();
//		$form = $this->createForm(CalificacionesType::class, $calificacione);
		$form = $this->createFormBuilder($calificacione)
				->add('idMateria', EntityType::class, [
					'class' => Materias::class,
					'choices' => $alumno->getMaterias(),
					'choice_label' => 'nombre',
				])
//			->add('idMateria', $materias)
//				->add('idMateria', EntityType::class, [
//					'class' => Materias::class,
//					'choice_label' => 'nombre'
//				])
				->add('idCiclo', EntityType::class, [
					'class' => Ciclos::class,
					'choice_label' => 'tipo'
				])
				->add('nota', TextType::class)
//				->add('Guardar', SubmitType::class)
				->getForm();

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
//			dump($form->getData());
//			die();
			$calificacione->setIdAlumno($alumno);
			//$calificacione->setIdMateria($alumno);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($calificacione);
			$entityManager->flush();

			return $this->redirectToRoute('calificaciones_new');
		}

		return $this->render('calificaciones/new.html.twig', [
					'form' => $form->createView(),
		]);
	}

	/**
	 * @Route("/{idAlumno}", name="calificaciones_show", methods={"GET"})
	 */
	public function show(Calificaciones $calificacione): Response {
		return $this->render('calificaciones/show.html.twig', [
					'calificacione' => $calificacione,
		]);
	}

	/**
	 * @Route("/{idAlumno}/edit", name="calificaciones_edit", methods={"GET","POST"})
	 */
	public function edit(Request $request, Calificaciones $calificacione): Response {
//		dump($calificacione);
//		die();
		//$calificaciones= new Calificaciones();
//		$alumno = $this->getUser();
//		$form = $this->createFormBuilder($calificacione)
//				->add('idMateria', EntityType::class, [
//					'class' => Materias::class,
//					'choices' => $alumno->getMaterias(),
//					'choice_label' => 'nombre',
//				])
//				->add('idCiclo', EntityType::class, [
//					'class' => Ciclos::class,
//					'choice_label' => 'tipo'
//				])
//				->add('nota', TextType::class)
////				->add('Guardar', SubmitType::class)
//				->getForm();

		$form = $this->createForm(CalificacionesType::class, $calificacione);
//		dump($form);
//		die();
		$form->handleRequest($request);


		if ($form->isSubmitted() && $form->isValid()) {
//			dump($form);
//			die();

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
	 * @Route("/{idAlumno}/delete", name="calificaciones_delete", methods={"GET","POST","DELETE"})
	 */
	public function delete(Request $request, Calificaciones $calificacione): Response {

		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->remove($calificacione);
		$entityManager->flush();

//		if ($this->isCsrfTokenValid('delete' . $calificacione->getIdAlumno(), $request->request->get('_token'))) {
//			$entityManager = $this->getDoctrine()->getManager();
//			$entityManager->remove($calificacione);
//			$entityManager->flush();
//		}

		return $this->redirectToRoute('calificaciones_index');
	}

}
