<?php

namespace App\Controller;

use App\Entity\Alumnos;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Security\StubAuthenticator;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\EntityManagerInterface;

class RegistroController extends AbstractController {

	/**
	 * @Route("/registro", name="registro")
	 */
	public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response {
		$alumno = new Alumnos();

		$form = $this->createFormBuilder($alumno)
				->add('nombre', TextType::class)
				->add('apellidos', TextType::class)
				->add('email', EmailType::class)
				->add('password', PasswordType::class, [
					'mapped' => false,
					'constraints' => [
						new NotBlank([
							'message' => 'Por favor ingrese una contraseña',
								]),
						new Length([
							'min' => 6,
							'minMessage' => 'Su contraseña debe tener al menos {{ limit }} caracteres',
							'max' => 4096,
								]),
					],
				])
				->add('save', SubmitType::class, ['label' => 'Enviar'])
				->getForm();

		$form->handleRequest($request);

		$error = null;

		if ($form->isSubmitted() && $form->isValid()) {
			//Comprobar que el email no se repita
			$email = $form->get('email')->getData();
			$repo = $this->getDoctrine()->getRepository(Alumnos::class);
			$status = $repo->findOneBy(['email' => $email]);
			
			if (!$status) {							
				$alumno = $form->getData();
				$alumno->setPassword(
						$passwordEncoder->encodePassword(
								$alumno, $form->get('password')->getData()
						)
				);
				$alumno->setRole('ROLE_USER');

				$em = $this->getDoctrine()->getManager();
				$em->persist($alumno);
				$em->flush();

				return $this->redirectToRoute('app_login');
			} else {
				$error = '¡El usuario ya existe, por favor ingrese otro email!';
			}
		}

		return $this->render('registro/registro.html.twig', [
					'form' => $form->createView(),
					'error' => $error,
		]);
	}

}
