<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use App\Entity\Section;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SectionEtudiantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $sections = ['GL','RT','IMI', 'IIA','CBA','MPI','BIO','CH','Math','Sciences','arts'];
        for ($i =0; $i<count($sections) ; $i++){
            $etudiant = new Etudiant();
            $section = new Section();
            $section->setDesignation($sections[$i]);
            $manager->persist($section);
            $etudiant->setFirstname($faker->firstName);
            $etudiant->setName($faker->name);
            $etudiant->setSetion($section);
            $manager->persist($etudiant);
        }
        for ($i =0; $i<15 ; $i++){
            $etudiant = new Etudiant();
            $etudiant->setFirstname($faker->firstName);
            $etudiant->setName($faker->name);
            $manager->persist($etudiant);
        }
        $manager->flush();
    }
}
