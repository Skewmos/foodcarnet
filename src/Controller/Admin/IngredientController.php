<?php

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use App\Form\Ingredient1Type;
use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/ingredient")
 */
class IngredientController extends AbstractController
{
    /**
     * @Route("/", name="ingredient_index", methods={"GET"})
     * @param IngredientRepository $ingredientRepository
     * @return Response
     */
    public function index(IngredientRepository $ingredientRepository): Response
    {
        return $this->render('admin/ingredient/index.html.twig', [
            'ingredients' => $ingredientRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ingredient_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(Ingredient1Type::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ingredient);
            $entityManager->flush();

            return $this->redirectToRoute('ingredient_index');
        }

        return $this->render('admin/ingredient/new.html.twig', [
            'ingredient' => $ingredient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idingredient}", name="ingredient_show", methods={"GET"})
     * @param Ingredient $ingredient
     * @return Response
     */
    public function show(Ingredient $ingredient): Response
    {
        return $this->render('admin/ingredient/show.html.twig', [
            'ingredient' => $ingredient,
        ]);
    }

    /**
     * @Route("/{idingredient}/edit", name="ingredient_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Ingredient $ingredient
     * @return Response
     */
    public function edit(Request $request, Ingredient $ingredient): Response
    {
        $form = $this->createForm(Ingredient1Type::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ingredient_index');
        }

        return $this->render('admin/ingredient/edit.html.twig', [
            'ingredient' => $ingredient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idingredient}", name="ingredient_delete", methods={"DELETE"})
     * @param Request $request
     * @param Ingredient $ingredient
     * @return Response
     */
    public function delete(Request $request, Ingredient $ingredient): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ingredient->getIdingredient(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ingredient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ingredient_index');
    }
}
