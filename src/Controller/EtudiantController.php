<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\Section;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    #[Route('/add/{name}/{firstname}/{sectionName}', name: 'etudiant.add')]
    public function addEtudiant(ManagerRegistry $doctrine, $name, $firstname,$sectionName): Response
    {
        $manager = $doctrine->getManager();
        $etudiant = new Etudiant();
        $section = new Section();
        $section->setDesignation($sectionName);
        $manager->persist($section);
        $etudiant->setFirstname($firstname);
        $etudiant->setName($name);
        $etudiant->setSetion($section);
        $manager->persist($etudiant);
        $manager->flush();
        $this->addFlash('success','Etudiant ajouté!');
        return $this->redirectToRoute('etudiant');
    }

}
