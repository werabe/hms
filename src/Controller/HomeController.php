<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index():Response
    {

        //
        $two_square=2*2;
        $people=array("name"=>"Kebede","age"=>15);
     
        return $this->render('home/index.twig', [
         "name"=>"Miniyahil",
         "square"=>$two_square,

        ]);
    }
    #[Route('/about', name: 'about')]
    public function about():Response
    { 
     
        return $this->render('home/about.twig', [
         "about"=>"About Werabe University",

        ]);
    }

   
}
