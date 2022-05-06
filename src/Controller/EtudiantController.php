<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\Section;
use App\Form\EtudiantType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/etudiant')]

class EtudiantController extends AbstractController
{
    #[Route('/', name: 'etudiant')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Etudiant::class);
        $etudiants = $repository->findAll();
        return $this->render('etudiant/index.html.twig', [
            'etudiants' => $etudiants,
        ]);
    }
    #[Route('/edit/{id?0}', name: 'etudiant.edit')]
    public function addEtudiant(ManagerRegistry $doctrine, Etudiant $etudiant = null, Request $request): Response
    {
        $new = false;

        if (!$etudiant){
            $etudiant = new Etudiant();
            $new = true;
        }
        $form = $this->createForm(EtudiantType::class, $etudiant);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            $entityManager = $doctrine->getManager();
            $entityManager->persist($etudiant);
            $entityManager->flush();

            if ($new){
                $message =" a été ajoutée avec succès";
            }else{
                $message =" a été mise à jour avec succès";
            }

            $this->addFlash('success', $etudiant->getName(). $message);
            return $this->redirectToRoute('etudiant');
        }else{
            return $this->render('etudiant/add-etudiant.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

#[Route('/delete/{id}', name: 'etudiant.delete')]
public function removeEtudiant(ManagerRegistry $doctrine, Etudiant $etudiant = null):Response
{
    if($etudiant){
        $manager = $doctrine->getManager();
        $manager->remove($etudiant);
        $manager->flush();
        $this->addFlash('success', ' Etudiant supprimé avec succès');
    }else{
        $this->addFlash('error', "L'étudiant n'existe pas");
    }
    return $this->redirectToRoute("etudiant");

}

}
