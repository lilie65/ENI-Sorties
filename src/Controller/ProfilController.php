<?php

namespace App\Controller;

use App\Repository\ParticipantRepository;
use App\Repository\SortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil/{pseudo}", name="profil")
     */
    public function profil(string $pseudo,
                           ParticipantRepository $participantRepository): Response
    {
        $sessionUser = $this->getUser();
        $userEMail = $sessionUser->getUsername();
        $user = $participantRepository->findOneBy(['email' => $userEMail]);
        $participant = $participantRepository->findOneBy(['pseudo' => $pseudo]);
        if ($pseudo == $user->getPseudo()) {
            return $this->redirectToRoute('update');
        } elseif (!$participant) {
            throw $this->createNotFoundException("Ce profil n'existe pas");
        }
        return $this->render('profil/profil.html.twig', [
            'participant' => $participant,
        ]);
    }

}

