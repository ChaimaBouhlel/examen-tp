<?php

namespace App\DataFixtures;

use App\Entity\Section;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SectionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $sections = ['GL','RT','IIA','IMI'];
        for ($i =0; $i<count($sections) ; $i++){
            $section = new Section();
            $section->setDesignation($sections[$i]);
            $manager->persist($section);
        }


        $manager->flush();
    }
}
