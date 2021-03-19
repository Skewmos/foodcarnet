<?php

namespace App\Controller\Admin;

use App\Entity\Fix;
use App\Form\FixType;
use App\Repository\FixRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/fix")
 */
class FixController extends AbstractController
{
    /**
     * @Route("/", name="fix_index", methods={"GET"})
     */
    public function index(FixRepository $fixRepository): Response
    {
        return $this->render('admin/fix/index.html.twig', [
            'fixes' => $fixRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="fix_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $fix = new Fix();
        $form = $this->createForm(FixType::class, $fix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fix);
            $entityManager->flush();

            return $this->redirectToRoute('fix_index');
        }

        return $this->render('admin/fix/new.html.twig', [
            'fix' => $fix,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idfix}", name="fix_show", methods={"GET"})
     */
    public function show(Fix $fix): Response
    {
        return $this->render('admin/fix/show.html.twig', [
            'fix' => $fix,
        ]);
    }

    /**
     * @Route("/{idfix}/edit", name="fix_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Fix $fix): Response
    {
        $form = $this->createForm(FixType::class, $fix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fix_index');
        }

        return $this->render('admin/fix/edit.html.twig', [
            'fix' => $fix,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idfix}", name="fix_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Fix $fix): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fix->getIdfix(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fix);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fix_index');
    }
}
