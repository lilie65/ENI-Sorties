<?php

namespace App\Controller;

use App\Entity\Lieu;
use App\Entity\Sortie;
use App\Form\SortieType;
use App\Repository\CampusRepository;
use App\Repository\EtatRepository;
use App\Repository\ParticipantRepository;
use App\Repository\VilleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{

    /**
     * @Route ("/sortie/nouvelle", name="sortie_nouvelle")
     */
    public function nouvelle( Request $request,
                            EntityManagerInterface $entityManager,
                            ParticipantRepository $participantRepository,
                            CampusRepository $campusRepository,
                            EtatRepository $etatRepository,
                            VilleRepository $villeRepository
                            ): Response
    {
        $sortie = new Sortie();
        $lieu = new Lieu();

        //Identification et recup du User
        $sessionUser= $this->getUser();
        $userEMail=$sessionUser->getUsername();
        $participant= $participantRepository->findOneBy(['email' => $userEMail]);

        //Recup Etat par défaut et CampusUser
        $etatDefaut=$etatRepository->findOneBy(['libelle'=>'Créée']);
        $userCampus= $campusRepository->findOneBy(['id'=>$participant->getCampus()->getId()]);

        $sortieForm = $this->createForm(SortieType::class, $sortie);
        $sortieForm->handleRequest($request);

        if ($sortieForm->isSubmitted() && $sortieForm->isValid()) {

            //Creation Lieu
            $lieu ->setNom($sortieForm->get('lieu')->getData());
            $lieu->setVille($sortieForm->get('ville')->getData());
            $lieu->setLatitude(0);
            $lieu->setLongitude(0);
            $lieu->setRue('');

            //Ville->Lieu
            $villeForm=$sortieForm->get('ville')->getNormData();
            $ville=$villeRepository->find($villeForm);
            $ville->addLieu($lieu);

            //Sortie add attrs manquants: Etat Organisateur/participants Campus Lieu
            $sortie->setEtat($etatDefaut);
            $sortie->setOrganisateur($participant);
            $sortie->setCampus($userCampus);
            $sortie->setLieu($lieu);

            //Lieu/Participant/Campus -> Lieu
            $lieu->addSorty($sortie);
            $participant->addSortiesOrganisee($sortie);
            $userCampus->addSorty($sortie);

            $entityManager->persist($sortie);
            $entityManager->persist($lieu);
            $entityManager->flush();

            $this->addFlash('success', 'Nouvelle sortie ajoutée.');

            return $this->redirectToRoute('sortie_nouvelle');
        }

        return $this->render('sortie/nouvelle.html.twig', [
            'sortieForm'=> $sortieForm->createView(),
        ]);
    }

}
