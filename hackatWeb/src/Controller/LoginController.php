<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
#[Route('/login', name: 'app_login')]
public function index(AuthenticationUtils $authenticationUtils): Response
{
// get the login error if there is one
$error = $authenticationUtils->getLastAuthenticationError();
 $lastUsername=$authenticationUtils->getLastUsername();
 return $this->render('login/login.html.twig', ['last_username'=>$lastUsername, 'errors'=>$error
]);
}
#[Route('/logout', name: 'app_logout')]
public function logout()
{

}
}
