<?php

namespace App\Controller;

use App\Entity\Calificaciones;
use App\Entity\Materias;
use App\Form\CalificacionesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/calificaciones")
 */
class CalificacionesController extends AbstractController {
	/**
	 * @Route("/choose", name="calificaciones_choose", methods={"GET","POST"})
	 */
	public function choose(Request $request): Response {
		//$materias= new Materias();
		$materias1 = $this->getDoctrine()
				->getRepository(Materias::class)
				->findAll();

		$repo = $this->getDoctrine()->getRepository(Materias::class);
		//$materias = $repo->findOneBy(['email' => $email]);
//		$c= new Calificaciones();
//		$alumno= $c->getAlumno();
//		$materias1= $alumno->getMateria();
		dump($materias1);
		//dump($materias->getMateria());
		die();
//		foreach ($materias as $clave => $valor) {
//			print "$clave => $valor\n";
//		}
//		$materias2= get_encode($materias);
		$array = json_decode(json_encode($materias[0]->nombre), true);
		dump($array);
		die();

		for ($i = 0; $i <= count($materias); $i++) {
			echo $materias[$i]['Materias'] . nombre;
		}
//		forEach($materias in $materia){
//			echo $materias[0]['Materias'].nombre;
//		}
		die();

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
	 * @Route("/", name="calificaciones_index", methods={"GET"})
	 */
	public function index(): Response {
		$alumno = $this->getUser();
		$materias = $alumno->getMaterias();
//		dump($materias);
//		die();
		$id_alumno = $alumno->getId();
//		$c= new Calificaciones();
//		$p= $c->getMateria($materias);
//		dump($p);
//		die();
		$status = null;

		if ($materias) {
			//			echo 'existen materias';
			$em = $this->getDoctrine()->getManager();
			$conn = $em->getConnection();
//			$sql = ' SELECT * FROM calificaciones c 
//					WHERE c.alumno_id= :id_alumno				
//					';

			$sql = ' SELECT c.id, m.nombre, c.nota, c.ciclo, c.porcentaje FROM materias m, calificaciones c
					WHERE c.alumno_id= :id_alumno	
					AND m.id=c.materia_id 
					';


			$stmt = $conn->prepare($sql);
			$stmt->execute(['id_alumno' => $id_alumno]);
			$calificaciones = $stmt->fetchAll();
			//SELECT m.nombre, c.nota, c.ciclo, c.porcentaje FROM materias m, calificaciones c WHERE c.alumno_id=2 AND m.id=c.materia_id 
//			dump($res);
//			die();
		} else {
			$status = 'Primero tienes que crear alguna materia';
//			echo 'NO existen materias';
		}
//		die();
//		$materias = $m->getMateria();
//		dump($materias);
		//die();
//		$calificaciones = $this->getDoctrine()
//				->getRepository(Calificaciones::class)
//				->findAll();

		return $this->render('calificaciones/index.html.twig', [
					'calificaciones' => $calificaciones,
					'status' => $status,
					'materias' => $materias,
		]);
	}

	/**
	 * @Route("/new", name="calificaciones_new", methods={"GET","POST"})
	 */
	public function nuevo(Request $request): Response {
		//$materias= new Materias();
		$materias1 = $this->getDoctrine()
				->getRepository(Materias::class)
				->findAll();

		$repo = $this->getDoctrine()->getRepository(Materias::class);
		//$materias = $repo->findOneBy(['email' => $email]);
//		$c= new Calificaciones();
//		$alumno= $c->getAlumno();
//		$materias1= $alumno->getMateria();
		dump($materias1);
		//dump($materias->getMateria());
		die();
//		foreach ($materias as $clave => $valor) {
//			print "$clave => $valor\n";
//		}
//		$materias2= get_encode($materias);
		$array = json_decode(json_encode($materias[0]->nombre), true);
		dump($array);
		die();

		for ($i = 0; $i <= count($materias); $i++) {
			echo $materias[$i]['Materias'] . nombre;
		}
//		forEach($materias in $materia){
//			echo $materias[0]['Materias'].nombre;
//		}
		die();

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
	 * @Route("/{id}", name="calificaciones_show", methods={"GET"})
	 */
	public function show(Calificaciones $calificacione): Response {
		return $this->render('calificaciones/show.html.twig', [
					'calificacione' => $calificacione,
		]);
	}

	/**
	 * @Route("/{id}/edit", name="calificaciones_edit", methods={"GET","POST"})
	 */
	public function edit(Request $request, Calificaciones $calificacione): Response {
		$form = $this->createForm(CalificacionesType::class, $calificacione);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$this->getDoctrine()->getManager()->flush();

			return $this->redirectToRoute('calificaciones_index', [
						'id' => $calificacione->getId(),
			]);
		}

		return $this->render('calificaciones/edit.html.twig', [
					'calificacione' => $calificacione,
					'form' => $form->createView(),
		]);
	}

	/**
	 * @Route("/{id}", name="calificaciones_delete", methods={"DELETE"})
	 */
	public function delete(Request $request, Calificaciones $calificacione): Response {
		if ($this->isCsrfTokenValid('delete' . $calificacione->getId(), $request->request->get('_token'))) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->remove($calificacione);
			$entityManager->flush();
		}

		return $this->redirectToRoute('calificaciones_index');
	}

}
