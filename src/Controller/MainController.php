<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{

    /**
     * @Route ("/", name="main_home")
     */
    public function home()
    {
        return $this->render('main/home.html.twing');
    }
}