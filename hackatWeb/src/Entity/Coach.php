<?php

namespace App\Entity;

use App\Repository\CoachRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoachRepository::class)]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap(['Motivant' => CoachMotivant::class, 'Metier' => CoachMetier::class, 'Technique'=>CoachTechnique::class])]

abstract class Coach
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomCoach = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lienLinkedin = null;

    /**
     * @var Collection<int, Hackaton>
     */
    #[ORM\ManyToMany(targetEntity: Hackaton::class, mappedBy: 'lesCoachs')]
    private Collection $hackatons;

    public function __construct()
    {
        $this->hackatons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCoach(): ?string
    {
        return $this->nomCoach;
    }

    public function setNomCoach(string $nomCoach): static
    {
        $this->nomCoach = $nomCoach;

        return $this;
    }

    public function getLienLinkedin(): ?string
    {
        return $this->lienLinkedin;
    }

    public function setLienLinkedin(?string $lienLinkedin): static
    {
        $this->lienLinkedin = $lienLinkedin;

        return $this;
    }

    /**
     * @return Collection<int, Hackaton>
     */
    public function getHackatons(): Collection
    {
        return $this->hackatons;
    }

    public function addHackaton(Hackaton $hackaton): static
    {
        if (!$this->hackatons->contains($hackaton)) {
            $this->hackatons->add($hackaton);
            $hackaton->addLesCoach($this);
        }

        return $this;
    }

    public function removeHackaton(Hackaton $hackaton): static
    {
        if ($this->hackatons->removeElement($hackaton)) {
            $hackaton->removeLesCoach($this);
        }

        return $this;
    }
}
