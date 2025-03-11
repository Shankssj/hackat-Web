<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Hackaton;
use App\Entity\Inscription;
use App\Entity\Utilisateur;


class HackatonController extends AbstractController 
{
    #[Route('/hackaton', name: 'app_hackaton')]
    public function index(EntityManagerInterface $em): Response
    {   
        $repository = $em->getRepository(Hackaton::class);

        // Récupérer les hackathons à venir (date supérieure à aujourd'hui)
        $queryBuilderFutur = $repository->createQueryBuilder('h')
            ->where('h.dateDebutHack > :today') 
            ->setParameter('today', new \DateTime()) 
            ->orderBy('h.dateDebutHack', 'ASC'); // Hackathons futurs triés par ordre croissant
        $hackatonsFuturs = $queryBuilderFutur->getQuery()->getResult();

        // Récupérer les hackathons passés (date inférieure ou égale à aujourd'hui)
        $queryBuilderAncien = $repository->createQueryBuilder('h')
            ->where('h.dateDebutHack <= :today') 
            ->setParameter('today', new \DateTime()) 
            ->orderBy('h.dateDebutHack', 'DESC'); // Hackathons passés triés par ordre décroissant
        $hackatonsAnciens = $queryBuilderAncien->getQuery()->getResult();

        return $this->render('hackaton/hackaton.html.twig', [
            'lesHackaton' => $hackatonsFuturs,
            'lesHackAncien' => $hackatonsAnciens
        ]);
    }

    #[Route('/Details/{id}', name: 'app_details')]
    public function details(int $id, EntityManagerInterface $em): Response 
    {
        $repository = $em->getRepository(Hackaton::class);
        $detail = $repository->find($id);
        $coachsHackaton = $detail->getLesCoachs();
        $role = get_class($coachsHackaton);
        dump($coachsHackaton);
        //dump de role
        return $this->render('hackaton/Details.html.twig', [
            'leDetails' => $detail,
            'coachsHackaton' => $coachsHackaton,
            'role' => $role
        ]);
    }
    

}


    #[Route('/mesHackathons',name :'app_mesHacks')]
    public function mesHack( EntityManagerInterface $detail): Response {
        $userConnected= $this->getUser();
     //   dump($userConnected->getId());
        $repository2 = $detail->getRepository(Inscription::class);
        $lesInscriptions = $repository2->findBy(['unUtilisateur'=> $userConnected]);
        dump($lesInscriptions);
       
       // $repository2->get();

        return $this->render('login/mesHackathons.html.twig', ['lesHackaton'=>$lesInscriptions
    ]);
    }
}


