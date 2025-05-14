<?php

namespace App\Entity;

use App\Repository\CoachTechniqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoachTechniqueRepository::class)]
class CoachTechnique extends Coach
{
    /**
     * @var Collection<int, CompetenceTechnique>
     */
    #[ORM\ManyToMany(targetEntity: CompetenceTechnique::class, inversedBy: 'lesCoachTechniques')]
    private Collection $lesCompetencesTechniques;

    public function __construct()
    {
        $this->lesCompetencesTechniques = new ArrayCollection();
    }

    /**
     * @return Collection<int, CompetenceTechnique>
     */
    public function getLesCompetencesTechniques(): Collection
    {
        return $this->lesCompetencesTechniques;
    }

    public function addLesCompetencesTechnique(CompetenceTechnique $lesCompetencesTechnique): static
    {
        if (!$this->lesCompetencesTechniques->contains($lesCompetencesTechnique)) {
            $this->lesCompetencesTechniques->add($lesCompetencesTechnique);
        }

        return $this;
    }

    public function removeLesCompetencesTechnique(CompetenceTechnique $lesCompetencesTechnique): static
    {
        $this->lesCompetencesTechniques->removeElement($lesCompetencesTechnique);

        return $this;
    }
}
