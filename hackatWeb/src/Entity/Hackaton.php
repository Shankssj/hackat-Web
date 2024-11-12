<?php

namespace App\Entity;

use App\Repository\HackatonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HackatonRepository::class)]
class Hackaton
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbPlacesHack = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateLimiteHack = null;

    #[ORM\Column(length: 255)]
    private ?string $themeHack = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebutHack = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFinHack = null;

    #[ORM\Column(length: 255)]
    private ?string $heureDebutHack = null;

    #[ORM\Column(length: 255)]
    private ?string $heureFinHack = null;

    #[ORM\Column(length: 255)]
    private ?string $villeHack = null;

    #[ORM\Column(length: 255)]
    private ?string $cpHack = null;

    #[ORM\Column(length: 255)]
    private ?string $rueHack = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbPlacesHack(): ?int
    {
        return $this->nbPlacesHack;
    }

    public function setNbPlacesHack(int $nbPlacesHack): static
    {
        $this->nbPlacesHack = $nbPlacesHack;

        return $this;
    }

    public function getDateLimiteHack(): ?\DateTimeInterface
    {
        return $this->dateLimiteHack;
    }

    public function setDateLimiteHack(\DateTimeInterface $dateLimiteHack): static
    {
        $this->dateLimiteHack = $dateLimiteHack;

        return $this;
    }

    public function getThemeHack(): ?string
    {
        return $this->themeHack;
    }

    public function setThemeHack(string $themeHack): static
    {
        $this->themeHack = $themeHack;

        return $this;
    }

    public function getDateDebutHack(): ?\DateTimeInterface
    {
        return $this->dateDebutHack;
    }

    public function setDateDebutHack(\DateTimeInterface $dateDebutHack): static
    {
        $this->dateDebutHack = $dateDebutHack;

        return $this;
    }

    public function getDateFinHack(): ?\DateTimeInterface
    {
        return $this->dateFinHack;
    }

    public function setDateFinHack(\DateTimeInterface $dateFinHack): static
    {
        $this->dateFinHack = $dateFinHack;

        return $this;
    }

    public function getHeureDebutHack(): ?string
    {
        return $this->heureDebutHack;
    }

    public function setHeureDebutHack(string $heureDebutHack): static
    {
        $this->heureDebutHack = $heureDebutHack;

        return $this;
    }

    public function getHeureFinHack(): ?string
    {
        return $this->heureFinHack;
    }

    public function setHeureFinHack(string $heureFinHack): static
    {
        $this->heureFinHack = $heureFinHack;

        return $this;
    }

    public function getVilleHack(): ?string
    {
        return $this->villeHack;
    }

    public function setVilleHack(string $villeHack): static
    {
        $this->villeHack = $villeHack;

        return $this;
    }

    public function getCpHack(): ?string
    {
        return $this->cpHack;
    }

    public function setCpHack(string $cpHack): static
    {
        $this->cpHack = $cpHack;

        return $this;
    }

    public function getRueHack(): ?string
    {
        return $this->rueHack;
    }

    public function setRueHack(string $rueHack): static
    {
        $this->rueHack = $rueHack;

        return $this;
    }
}
