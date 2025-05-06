<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Hackaton;
use App\Entity\Inscription;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\JsonResponse;


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

        $user = $this->getUser();
    
        $isFavori = false;
    
        if ($user !== null) {
            $isFavori = $user->getLesFavoris()->contains($detail);
        }
        //dump de role
        return $this->render('hackaton/Details.html.twig', [
            'leDetails' => $detail,
            'coachsHackaton' => $coachsHackaton,
            'role' => $role,
            'isFavori' => $isFavori
        ]);   
    }

    

    #[Route('/mesHackathons', name: 'app_mesHacks')]
    public function mesHack(EntityManagerInterface $detail): Response
    {
        $userConnected = $this->getUser();
        //   dump($userConnected->getId());
        $repository2 = $detail->getRepository(Inscription::class);
        $lesInscriptions = $repository2->findBy(['unUtilisateur' => $userConnected]);
        dump($lesInscriptions);

        
        $lesFavoris= $userConnected->getLesFavoris();
        //   dump($userConnected->getId());


        return $this->render('login/mesHackathons.html.twig', [
            'lesHackaton' => $lesInscriptions,
            'lesFavoris' => $lesFavoris,
            'utilisateur' => $userConnected
        ]);
    }




    #[Route('/inscriptionHack/{id}', name: 'app_inscriptionHack')]
public function inscriptionHack(int $id, EntityManagerInterface $detail): Response
{
    $userConnected = $this->getUser();

    $repository2 = $detail->getRepository(Inscription::class);
    $repository = $detail->getRepository(Hackaton::class);
    $hackatonSelectionne =  $repository->find($id);
    //$idHackSelec = $hackatonSelectionne->getId();

    $newInscriptions = new Inscription();
    $newInscriptions->setUnUtilisateur($userConnected);
    $newInscriptions->setUnHackaton($hackatonSelectionne);
    $newInscriptions->setDateInscription(new \DateTime()); // Ajout de la date actuelle

    $detail->persist($newInscriptions);
    $detail->flush();

    return new Response('Nouvelle inscription enregistrée');
}

#[Route('/mesFavoris/{id}/favoris', name: 'app_mesFavoris')]
public function mesFavoris(int $id, EntityManagerInterface $favoris): Response
{
    $userConnected = $this->getUser();

    $repository = $favoris->getRepository(Utilisateur::class);
    $repository2 = $favoris->getRepository(Hackaton::class);

    $hackathonFavoris = $repository2->find($id);
    var_dump($hackathonFavoris);
    $addFavoris = $userConnected->addLesFavori($hackathonFavoris);

    $favoris->persist($addFavoris);
    $favoris->flush();

    

    return $this->redirectToRoute('app_details', ['id' => $id]);

    // $data=[
    //     'message' => $userConnected->getLesFavoris(),
    //     'status'=>200

    // ];
    // return new JsonResponse($data);
   /*  return $this->render('hackaton/Details.html.twig', [
        'userId' => $userConnected,
        'lesHackathonsFavoris' => $userConnected->getLesFavoris()
    ]); */


}



#[Route('/mesfav', name: 'app_mesFav')]
    public function mesFav(EntityManagerInterface $detail): Response
    {
        $userConnected = $this->getUser();
        $lesFavoris= $userConnected->getLesFavoris();
        //   dump($userConnected->getId());
       



        return $this->render('login/favoris.html.twig', [
            'lesFavoris' => $lesFavoris,
            'utilisateur'=> $userConnected
            
        ]);
    }
}
