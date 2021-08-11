<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     * @Route ("/home", name="main_home")
     */
    public function home()
    {
        return $this->render('main/home.html.twing');
    }


    /**
     * @Route ("/sorties/nouvelle", name="main_form")
     */
    public function form()
    {
        return $this->render('main/form.html.twing');
    }


}