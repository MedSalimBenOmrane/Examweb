<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NombreDeVisiteController extends AbstractController
{
    #[Route('/nombre/de/visite', name: 'app_nombre_de_visite')]
    public function index(Request $req): Response
    {
        $session=$req->getSession();
        if (!$session->has('nbr'))
        {
            $nbr=1 ;
            $session->set('nbr', $nbr);
        }
        else {
            $nbr=$session->get('nbr');
            $nbr=$nbr + 1 ;
            $session->set('nbr', $nbr);
        }
        return $this->render('nombre_de_visite/index.html.twig', [
            'controller_name' => 'NombreDeVisiteController',
            'nbr'=>$nbr
        ]);
    }
}
