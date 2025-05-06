<?php

namespace App\Entity;

use App\Repository\CoachMetierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoachMetierRepository::class)]
class CoachMetier extends Coach
{
    /**
     * @var Collection<int, CompetenceMetier>
     */
    #[ORM\ManyToMany(targetEntity: CompetenceMetier::class, inversedBy: 'lesCoachMetiers')]
    private Collection $lesCompetencesMetier;

    public function __construct()
    {
        $this->lesCompetencesMetier = new ArrayCollection();
    }

    /**
     * @return Collection<int, CompetenceMetier>
     */
    public function getLesCompetencesMetier(): Collection
    {
        return $this->lesCompetencesMetier;
    }

    public function addLesCompetencesMetier(CompetenceMetier $lesCompetencesMetier): static
    {
        if (!$this->lesCompetencesMetier->contains($lesCompetencesMetier)) {
            $this->lesCompetencesMetier->add($lesCompetencesMetier);
        }

        return $this;
    }

    public function removeLesCompetencesMetier(CompetenceMetier $lesCompetencesMetier): static
    {
        $this->lesCompetencesMetier->removeElement($lesCompetencesMetier);

        return $this;
    }
}
