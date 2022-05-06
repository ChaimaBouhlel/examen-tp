<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 70)]
    private $name;

    #[ORM\Column(type: 'string', length: 70)]
    private $firstname;

    #[ORM\ManyToOne(targetEntity: Section::class, inversedBy: 'etudiants')]
    private $setion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getSetion(): ?Section
    {
        return $this->setion;
    }

    public function setSetion(?Section $setion): self
    {
        $this->setion = $setion;

        return $this;
    }
}
