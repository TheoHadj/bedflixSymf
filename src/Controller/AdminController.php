<?php

namespace App\Controller;

use App\Entity\Films;
use App\Entity\Series;
use App\Form\FilmType;
use App\Form\SerieType;
use App\Repository\FilmsRepository;
use App\Repository\SeriesRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin_dashboard')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    #[Route('/admin/add-film', name: 'admin_add_film')]
    public function addFilm(Request $request, FilmsRepository $filmsRepository): Response
    {
        $film = new Films();
        $form = $this->createForm(FilmType::class, $film);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filmsRepository->saveFilm($film);

            $this->addFlash('success', 'Film ajouté avec succès !');
            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin/add_film.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/add-serie', name: 'admin_add_serie')]
    public function addSerie(Request $request, EntityManagerInterface $em, SeriesRepository $seriesRepository): Response
    {
        $serie = new Series();
        $form = $this->createForm(SerieType::class, $serie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $seriesRepository->saveFilm($serie);


            $this->addFlash('success', 'Série ajoutée avec succès !');
            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin/add_serie.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
