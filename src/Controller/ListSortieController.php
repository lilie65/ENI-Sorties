<?php

namespace App\Controller;

use App\Entity\ListRecherche;
use App\Entity\Participant;
use App\Entity\Sortie;
use App\Form\ListRechercheType;
use App\Repository\CampusRepository;
use App\Repository\SortieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ParticipantRepository;


class ListSortieController extends AbstractController
{
    /**
     * @Route("/list",name="list")
     */
    public function list(SortieRepository $sortieRepository, CampusRepository $campusRepository, Request $request): Response
    {
        $sorties = $sortieRepository->findAll();
        $listCampus = $campusRepository->findAll();


        $listRecherche = new ListRecherche();
        $searchForm = $this->createForm(ListRechercheType::class, $listRecherche);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted() && $searchForm->isValid()) {

            $sorties = $sortieRepository->filtreCampus($listRecherche, $this->getUser());

        }
        return $this->render('main/listSo.html.twig', [
            "sorties" => $sorties, "listCampus" => $listCampus, 'searchForm' => $searchForm->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete( $id)
    {
        $sortieSelectionner= $this->getDoctrine()->getRepository('App:Sortie')->find($id);

        $participant =$this->getUser();
        $sortieSelectionner->removeParticipant($participant);
        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->flush();
        return $this->redirectToRoute('list');
    }

    /**
     * @Route("/ajout/{id}", name="ajout")
     */
    public function ajout($id)
    {
        $sortieSelectionner= $this->getDoctrine()->getRepository('App:Sortie')->find($id);

        $user=  $this->getUser();
        $user->addSorty($sortieSelectionner);
        $sortieSelectionner->addParticipant($user);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('list');
    }
}
