<?php

namespace App\Controller;

use App\Entity\ProblemType;
use App\Form\ProblemTypeType;
use App\Repository\ProblemTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/problem/type')]
class ProblemTypeController extends AbstractController
{
    #[Route('/', name: 'problem_type_index', methods: ['GET'])]
    public function index(ProblemTypeRepository $problemTypeRepository): Response
    {
        return $this->render('problem_type/index.html.twig', [
            'problem_types' => $problemTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'problem_type_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $problemType = new ProblemType();
        $form = $this->createForm(ProblemTypeType::class, $problemType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($problemType);
            $entityManager->flush();

            return $this->redirectToRoute('problem_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('problem_type/new.html.twig', [
            'problem_type' => $problemType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'problem_type_show', methods: ['GET'])]
    public function show(ProblemType $problemType): Response
    {
        return $this->render('problem_type/show.html.twig', [
            'problem_type' => $problemType,
        ]);
    }

    #[Route('/{id}/edit', name: 'problem_type_edit', methods: ['GET','POST'])]
    public function edit(Request $request, ProblemType $problemType): Response
    {
        $form = $this->createForm(ProblemTypeType::class, $problemType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('problem_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('problem_type/edit.html.twig', [
            'problem_type' => $problemType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'problem_type_delete', methods: ['POST'])]
    public function delete(Request $request, ProblemType $problemType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$problemType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($problemType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('problem_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
