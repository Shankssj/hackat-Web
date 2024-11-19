<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InscriptionHackatonController extends AbstractController
{
    #[Route('/inscription/hackaton', name: 'app_inscription_hackaton')]
    public function index(): Response
    {
        return $this->render('inscription_hackaton/index.html.twig', [
            'controller_name' => 'InscriptionHackatonController',
        ]);
    }
}
