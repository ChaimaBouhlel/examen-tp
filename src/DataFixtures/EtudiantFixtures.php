<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use App\Entity\Personne;
use App\Entity\Section;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Faker\Factory;
use Symfony\Bridge\Doctrine\ManagerRegistry;

class EtudiantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i =0; $i<50 ; $i++) {
            $personne = new Etudiant();
            $personne->setFirstname($faker->firstName);
            $personne->setName($faker->name);
            $manager->persist($personne);
        }
        $manager->flush();
    }
}
