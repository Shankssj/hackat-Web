<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateInscription = null;

    #[ORM\ManyToOne]
    private ?Utilisateur $unUtilisateur = null;

    #[ORM\ManyToOne]
    private ?Hackaton $unHackaton = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): static
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getUnUtilisateur(): ?Utilisateur
    {
        return $this->unUtilisateur;
    }

    public function setUnUtilisateur(?Utilisateur $unUtilisateur): static
    {
        $this->unUtilisateur = $unUtilisateur;

        return $this;
    }

    public function getUnHackaton(): ?Hackaton
    {
        return $this->unHackaton;
    }

    public function setUnHackaton(?Hackaton $unHackaton): static
    {
        $this->unHackaton = $unHackaton;

        return $this;
    }
}
