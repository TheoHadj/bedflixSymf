<?php

namespace App\Controller;

use App\Entity\Films;
use App\Repository\CategorieRepository;
use App\Repository\FilmsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmsController extends AbstractController
{
    #[Route('/films', name: 'app_films')]
    public function index(FilmsRepository $filmRepository, CategorieRepository $categorieRepository, Request $request): Response
    {
        $films = $filmRepository->findAll();
        $categories = $categorieRepository->findAll();
        $selectedCategorie = $request->query->get('categorie');

        
        if ($selectedCategorie) {
            $films = $filmRepository->findBy(['categorie' => $selectedCategorie]);
        } else {
            $films = $filmRepository->findAll();
        }

        return $this->render('films/index.html.twig', [
            'films' => $films,
            'categories' => $categories,
            'selectedCategorie' => $selectedCategorie,
        ]);

    }



}
