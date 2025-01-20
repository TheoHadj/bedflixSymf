<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\SeriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SeriesController extends AbstractController
{
    #[Route('/series', name: 'app_series')]
    public function index(SeriesRepository $seriesRepository, CategorieRepository $categorieRepository, Request $request): Response
    {

        $series = $seriesRepository->findAll();
        $selectedCategorie = $request->query->get('categorie');
        $categories = $categorieRepository->findAll();

        if ($selectedCategorie) {
            $series= $seriesRepository->findBy(['categorie' => $selectedCategorie]);
        } else {
            $series = $seriesRepository->findAll();
        }

        return $this->render('series/index.html.twig', [
            'series' => $series,
            'categories' => $categories,
            'selectedCategorie' => $selectedCategorie,
        ]);

    }

}

