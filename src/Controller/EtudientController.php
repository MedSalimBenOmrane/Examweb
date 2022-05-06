<?php

namespace App\Controller;

use App\Entity\Etudient;
use App\Entity\Person;
use App\Entity\Voiture;
use App\Form\EtudientType;
use App\Form\VoitureType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class EtudientController extends AbstractController
{
    private $manager;
    private $repository;
    public function __construct(private ManagerRegistry $doctrine)
    {
        $this->manager = $this->doctrine->getManager();
        $this->repository = $this->doctrine->getRepository(Etudient::class);
    }
    #[Route('/etudient/list', name: 'app_affiche')]
    public function affiche(): Response
    {

        $data = $this->repository->findAll();
        return $this->render('etudient/index.html.twig', [
            'data' => $data
        ]);
    }



    #[Route('/etudient/addform', name: 'add_item')]
    public function addform(Request $req): Response
    {
        $new_item = new Etudient();

        $form = $this->createForm(EtudientType::class, $new_item);
        $form->handleRequest($req);

        if($form->isSubmitted()){
            $this->manager->persist($new_item);
            $this->manager->flush();

            return $this->redirectToRoute('app_affiche');
        }

        return $this->render('etudient/form.html.twig', [
            'add_form' => $form->createView(),
        ]);
    }

#[Route('/etudient/edit/{id}', name: 'edit')]

#[Route('etudient/edit/{id?0}', name: 'app_etudient_edit')]
public function edit(Request $request, Etudient $etudient = null): Response
{
    if (!$etudient) {
        $voiture = new Etudient();
    }

    $form = $this->createForm(EtudientType::class, $etudient);

    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
//
        $this->manager->persist($etudient);
        $this->manager->flush();
        return $this->redirectToRoute('app_affiche');
    }
    return $this->render('etudient/form.html.twig', [

        'add_form' => $form->createView(),
    ]);
}
    #[Route('etudient/delete/{id}', name: 'app_delete')]
    public function delete(Etudient $etudient = null): Response
    {

        if(!$etudient) {
            throw new NotFoundHttpException("Not Found");
        } else {
            $this->manager->remove($etudient);
            $this->manager->flush();
            $this->addFlash('success', "etudeint supprimée avec succès");
            return $this->redirectToRoute('app_affiche');
        }
    }





}

