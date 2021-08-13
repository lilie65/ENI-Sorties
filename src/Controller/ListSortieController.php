<?php

namespace App\Controller;

use App\Repository\SortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class ListSortieController extends AbstractController
{
    /**
     * @Route("/list",name="list")
     */
    public function list(SortieRepository $sortieRepository): Response
    {

        $sorties = $sortieRepository->findAll();

        return $this->render('main/listSo.html.twig', [
            "sorties" => $sorties
        ]);
    }
}
