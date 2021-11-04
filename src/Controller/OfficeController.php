<?php

namespace App\Controller;

use App\Entity\Office;
use App\Form\OfficeType;
use App\Repository\OfficeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OfficeController extends AbstractController
{
    #[Route('/office', name: 'office')]
    public function index(OfficeRepository $officeRepo): Response
    {
        $offices=$officeRepo->findAll();


        return $this->render('office/index.html.twig', [
            'offices' => $offices,
        ]);
    }
     #[Route('/office/{id}', name: 'detail')]
     public function detail(Office $office, OfficeRepository $officeRepo): Response
     {
        
       
 
 
         return $this->render('office/index.html.twig', [
         
         ]);
     }
      #[Route('/office/new', name: 'new_office')]
      public function new(Request $request): Response
      {
         

        $office=new Office();

        $office_form=$this->createForm(OfficeType::class,$office);

        $office_form->handleRequest($request);
         
        if($office_form->isSubmitted()){
            $em=$this->getDoctrine()->getManager();
              $em->persist($office);
              
              $em->flush();
        }


       



          return $this->render('office/new.html.twig', [
              'office_form' => $office_form->createView(),
          ]);
      }

    #[Route('/office/delete', name: 'office_delete')]
    public function delete(OfficeRepository $officeRepo): Response
    {
        $offices=$officeRepo->findOneBy(["name"=>"ICT"]);

       
        $em=$this->getDoctrine()->getManager();
        $em->remove($offices);
        $em->flush();


        return $this->render('office/index.html.twig', [
            'offices' => $offices,
        ]);
    }   
    }
