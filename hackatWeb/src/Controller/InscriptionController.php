<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription', methods: ['GET', 'POST'])]
    public function index(EntityManagerInterface $em, Request $request): Response
    {
        if ($request->isMethod('POST')){
            $nouveauUtilisateur = new Utilisateur();
            $nouveauUtilisateur->setNomUtil($request->request->get('lastname'));
            $nouveauUtilisateur->setPrenomUtil($request->request->get('firstname'));
            $nouveauUtilisateur->setMailUtil($request->request->get('email'));
            $nouveauUtilisateur->setTelUtil($request->request->get('phone'));
             $birthdate = $request->request->get('birthdate');
             if ($birthdate) {
                 $nouveauUtilisateur->setDateNaissUtil(new \DateTime($birthdate));
             }
 
             $nouveauUtilisateur->setLienPortfolioUtil($request->request->get('portfolio'));
 
             $nouveauUtilisateur->setIdentifiantUtil($request->request->get('username'));
            $mdpUtil = $request->request->get('password');
            $mdpUtilHash = password_hash($mdpUtil, PASSWORD_BCRYPT);
             $nouveauUtilisateur ->setMdpUtil($mdpUtilHash);
 
             $em->persist($nouveauUtilisateur);
             $em->flush();
            
        };
        
        return $this->render('inscription/inscription.html.twig', [
            //'controller_name' => 'InscriptionController',
        ]);
    }
}
