<?php

namespace App\Controller;

use App\Entity\HelpRequest;
use App\Form\HelpRequestType;
use App\Repository\HelpRequestRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/help/request')]
class HelpRequestController extends AbstractController
{
    #[Route('/', name: 'help_request_index', methods: ['GET'])]
    public function index(HelpRequestRepository $helpRequestRepository): Response
    {
        return $this->render('help_request/index.html.twig', [
            'help_requests' => $helpRequestRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'help_request_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $helpRequest = new HelpRequest();
        $form = $this->createForm(HelpRequestType::class, $helpRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
         
          $helpRequest->setRequestedAt(new DateTimeImmutable());
          $helpRequest->setStatus(0);
          $helpRequest->setRequestedBy($this->getUser());
           
          $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($helpRequest);
            $entityManager->flush();

            return $this->redirectToRoute('help_request_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('help_request/new.html.twig', [
            'help_request' => $helpRequest,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'help_request_show', methods: ['GET'])]
    public function show(HelpRequest $helpRequest): Response
    {
        return $this->render('help_request/show.html.twig', [
            'help_request' => $helpRequest,
        ]);
    }

    #[Route('/{id}/edit', name: 'help_request_edit', methods: ['GET','POST'])]
    public function edit(Request $request, HelpRequest $helpRequest): Response
    {
        $form = $this->createForm(HelpRequestType::class, $helpRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('help_request_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('help_request/edit.html.twig', [
            'help_request' => $helpRequest,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'help_request_delete', methods: ['POST'])]
    public function delete(Request $request, HelpRequest $helpRequest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$helpRequest->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($helpRequest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('help_request_index', [], Response::HTTP_SEE_OTHER);
    }
}
