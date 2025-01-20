<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class WebController extends AbstractController
{
    #[Route('/home', name: 'homepage')]
    public function index(HttpClientInterface $client): Response
    {
        $response = $client->request(
            'GET',
            'https://localhost:8001/test/api', );

        echo $response->getContent();
        return $this->render('web/index.html.twig', ['response' => $response->getContent()]);
    }
}

