<?php

namespace App\Controller;

use App\Entity\Hackaton;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ApiController extends AbstractController
{
    #[Route('/addFavori/{id}/favori', name: 'app_api_favoris')]
    public function index(int $id, EntityManagerInterface $em): Response
    {
        dump('ici');
        $userConnected = $this->getUser();
    
        $repository2 = $em->getRepository(Hackaton::class);
    
        $hackathonFavoris = $repository2->find($id);
        dump($hackathonFavoris);
        $userConnected->addLesFavori($hackathonFavoris);
    
        $em->persist($userConnected);
        $em->flush(); 
    
       /* $lesFavoris= $userConnected->getLesFavoris();
        dump($lesFavoris);
        $vrai = 0;
        foreach($lesFavoris as $unFavoris)
        {
            if ($unFavoris->getId() == $hackathonFavoris->getId())
            {
                $vrai = 1;
                break;
            }
           
           
        }*/

    
        $data=[
            'vrai'=> "ajout",
            'idHackathon' =>$id,
            'status'=> 200
    
        ];
        dump(new JsonResponse($data));
        return new JsonResponse($data);
    }

    #[Route('/suppFavoris/{id}/supp', name : 'app_supprimerFavoris')]
public function suppFavoris(int $id, EntityManagerInterface $em): Response
{

    $userConnected = $this->getUser();


    $repository2 = $em->getRepository(Hackaton::class);

    $hackathonFavoris = $repository2->find($id);
  //  var_dump($hackathonFavoris);
    $delFavoris = $userConnected->removeLesFavori($hackathonFavoris);

    $em->persist($delFavoris);
    $em->flush();

   /* $lesFavoris= $userConnected->getLesFavoris();
    $vrai=0;
    foreach($lesFavoris as $unFavoris)
        {
            if ($unFavoris->getId() == $id)
            {
                $vrai = 1;
                break;
            }
           
           
        }*/

    
        $data=[
            'vrai'=> "supp",
            'idHackathon' =>$id,
            'status'=> 200
    
        ];
        dump(new JsonResponse($data));
        return new JsonResponse($data);
}
}
