<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\RegistrationFormType;
use App\Form\UpdateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new Participant();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setMotPasse(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('list');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/update", name="update")
     */
    public function update(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user= $this->getUser();

        $updateForm = $this->createForm(UpdateType::class, $user);
        $updateForm->handleRequest($request);

        if ($updateForm->isSubmitted() && $updateForm->isValid()) {


            // encode the plain password if nouveauMP is not empty & conf=nouveauMP
            $nouveauMotPasse=$updateForm->get('nouveauMotPasse')->getData();
            if (!empty($nouveauMotPasse)) {

                $user->setMotPasse(
                    $passwordEncoder->encodePassword(
                        $user,
                        $updateForm->get('nouveauMotPasse')->getData()
                    )
                );
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('update');
        }

        return $this->render('profil/update.html.twig', [
            'participantForm' => $updateForm->createView(),
        ]);
    }

}
