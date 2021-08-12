<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\SortieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{

    /**
     * @Route ("/sortie/nouvelle", name="sortie_nouvelle")
     */
    public function nouvelle()
    {

        $sortie = new Sortie();
        $sortieForm = $this->createForm(SortieType::class, $sortie);



        return $this->render('sortie/nouvelle.html.twig', [
            'sortieForm'=> $sortieForm->createView(),
        ]);
    }

}
