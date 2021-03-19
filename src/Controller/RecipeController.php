<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchForm;
use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    /**
     * @Route("/", name="recipe")
     */
    public function index(RecipeRepository $recipeRepository): Response
    {
        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $recipes = $recipeRepository->findSearch();
        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipes,
            'form' => $form->createView()
        ]);
    }
}
