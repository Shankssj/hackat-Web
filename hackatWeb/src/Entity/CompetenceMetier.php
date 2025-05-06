<?php

namespace App\Entity;

use App\Repository\CompetenceMetierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetenceMetierRepository::class)]
class CompetenceMetier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $libelleMetier = null;

    /**
     * @var Collection<int, CoachMetier>
     */
    #[ORM\ManyToMany(targetEntity: CoachMetier::class, mappedBy: 'lesCompetencesMetier')]
    private Collection $lesCoachMetiers;

    public function __construct()
    {
        $this->lesCoachMetiers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleMetier(): ?string
    {
        return $this->libelleMetier;
    }

    public function setLibelleMetier(?string $libelleMetier): static
    {
        $this->libelleMetier = $libelleMetier;

        return $this;
    }

    /**
     * @return Collection<int, CoachMetier>
     */
    public function getLesCoachMetiers(): Collection
    {
        return $this->lesCoachMetiers;
    }

    public function addLesCoachMetier(CoachMetier $lesCoachMetier): static
    {
        if (!$this->lesCoachMetiers->contains($lesCoachMetier)) {
            $this->lesCoachMetiers->add($lesCoachMetier);
            $lesCoachMetier->addLesCompetencesMetier($this);
        }

        return $this;
    }

    public function removeLesCoachMetier(CoachMetier $lesCoachMetier): static
    {
        if ($this->lesCoachMetiers->removeElement($lesCoachMetier)) {
            $lesCoachMetier->removeLesCompetencesMetier($this);
        }

        return $this;
    }
}
