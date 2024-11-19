<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Hackaton;
class HackatonController extends AbstractController 
{
    
    #[Route('/hackaton', name: 'app_hackaton')]
    public function index( EntityManagerInterface $em): Response
    {   
        $repository = $em->getRepository(Hackaton::class);
        $hackatons = $repository->findBy([], ['dateDebutHack' => 'DESC']);
        $queryBuilder = $repository->createQueryBuilder('h')
                ->where('h.dateDebutHack <= :today')  // Filtrer par date >= aujourd'hui
             ->setParameter('today', new \DateTime())  // Passer la date d'aujourd'hui
                ->orderBy('h.dateDebutHack', 'ASC');  // Trier par dateDebutHack de manière croissante

// Exécuter la requête et obtenir les résultats
        $hackatonsAncien = $queryBuilder->getQuery()->getResult();
        return $this->render('hackaton/hackaton.html.twig', ['lesHackaton'=>$hackatons,'lesHackAncien'=>$hackatonsAncien
        ]);
    }
    #[Route('/Details/{id}',name :'app_details')]
    public function details( int $id ,EntityManagerInterface $detail): Response {
        $repository = $detail->getRepository(Hackaton::class);
        $detail = $repository->find($id);
        return $this->render('hackaton/Details.html.twig', ['leDetails'=>$detail
    ]);
    }
}