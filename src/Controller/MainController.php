<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     * @Route ("/list", name="main_home")
     */
    public function home()
    {
        return $this->render('main/listSo.html.twig');
    }





}