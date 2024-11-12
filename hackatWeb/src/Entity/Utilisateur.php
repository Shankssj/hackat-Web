<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomUtil = null;

    #[ORM\Column(length: 255)]
    private ?string $prenomUtil = null;

    #[ORM\Column(length: 255)]
    private ?string $mailUtil = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telUtil = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateNaissUtil = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lienPortfolioUtil = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $identifiantUtil = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mdpUtil = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUtil(): ?string
    {
        return $this->nomUtil;
    }

    public function setNomUtil(string $nomUtil): static
    {
        $this->nomUtil = $nomUtil;

        return $this;
    }

    public function getPrenomUtil(): ?string
    {
        return $this->prenomUtil;
    }

    public function setPrenomUtil(string $prenomUtil): static
    {
        $this->prenomUtil = $prenomUtil;

        return $this;
    }

    public function getMailUtil(): ?string
    {
        return $this->mailUtil;
    }

    public function setMailUtil(string $mailUtil): static
    {
        $this->mailUtil = $mailUtil;

        return $this;
    }

    public function getTelUtil(): ?string
    {
        return $this->telUtil;
    }

    public function setTelUtil(?string $telUtil): static
    {
        $this->telUtil = $telUtil;

        return $this;
    }

    public function getDateNaissUtil(): ?\DateTimeInterface
    {
        return $this->dateNaissUtil;
    }

    public function setDateNaissUtil(?\DateTimeInterface $dateNaissUtil): static
    {
        $this->dateNaissUtil = $dateNaissUtil;

        return $this;
    }

    public function getLienPortfolioUtil(): ?string
    {
        return $this->lienPortfolioUtil;
    }

    public function setLienPortfolioUtil(?string $lienPortfolioUtil): static
    {
        $this->lienPortfolioUtil = $lienPortfolioUtil;

        return $this;
    }

    public function getIdentifiantUtil(): ?string
    {
        return $this->identifiantUtil;
    }

    public function setIdentifiantUtil(?string $identifiantUtil): static
    {
        $this->identifiantUtil = $identifiantUtil;

        return $this;
    }

    public function getMdpUtil(): ?string
    {
        return $this->mdpUtil;
    }

    public function setMdpUtil(?string $mdpUtil): static
    {
        $this->mdpUtil = $mdpUtil;

        return $this;
    }
}
