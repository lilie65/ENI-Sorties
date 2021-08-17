<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\FiltreSortieType;
use App\Repository\CampusRepository;
use App\Repository\SortieRepository;
use http\Env\Request;
use PhpParser\Node\Expr\List_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ListSortieController extends AbstractController
{
    /**
     * @Route("/list",name="list")
     */
    public function list(SortieRepository $sortieRepository, CampusRepository $campusRepository): Response
    {

        $sorties = $sortieRepository->findAll();
        $listCampus = $campusRepository->findAll();
        if($listCampus->issubmitted() && $listCampus->isValid()){

        }

        return $this->render('main/listSo.html.twig', [
            "sorties" => $sorties, "listCampus" => $listCampus
        ]);
    }

}
