<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchForm;
use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeListeController extends AbstractController
{
    /**
     * @Route("/recipeListe", name="recipeListe")
     * @param RecipeRepository $recipeRepository
     * @param Request $request
     * @return Response
     */
    public function index(RecipeRepository $recipeRepository, Request $request): Response
    {
        $data = new SearchData();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        [$minPrice, $maxPrice] = $recipeRepository->findMinMax($data);
        $recipes = $recipeRepository->findSearch($data);
        return $this->render('recipeListe/index.html.twig', [
            'recipes' => $recipes,
            'form' => $form->createView(),
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice
        ]);
    }
}
