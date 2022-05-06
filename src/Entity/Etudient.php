<?php

namespace App\Entity;

use App\Repository\EtudientRepository;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Table("Etudient")]
#[ORM\Entity(repositoryClass: EtudientRepository::class)]
class Etudient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $pernom;

    #[ORM\ManyToOne(targetEntity: Section::class)]
    private $section;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPernom(): ?string
    {
        return $this->pernom;
    }

    public function setPernom(string $pernom): self
    {
        $this->pernom = $pernom;

        return $this;
    }

    public function getSection(): ?section
    {
        return $this->section;
    }

    public function setSection(?section $section): self
    {
        $this->section = $section;

        return $this;
    }
}
