<?php

namespace App\Entity;

use App\Repository\CompetenceTechniqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetenceTechniqueRepository::class)]
class CompetenceTechnique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $libelleTechnique = null;

    /**
     * @var Collection<int, CoachTechnique>
     */
    #[ORM\ManyToMany(targetEntity: CoachTechnique::class, mappedBy: 'lesCompetencesTechniques')]
    private Collection $lesCoachTechniques;

    public function __construct()
    {
        $this->lesCoachTechniques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleTechnique(): ?string
    {
        return $this->libelleTechnique;
    }

    public function setLibelleTechnique(?string $libelleTechnique): static
    {
        $this->libelleTechnique = $libelleTechnique;

        return $this;
    }

    /**
     * @return Collection<int, CoachTechnique>
     */
    public function getLesCoachTechniques(): Collection
    {
        return $this->lesCoachTechniques;
    }

    public function addLesCoachTechnique(CoachTechnique $lesCoachTechnique): static
    {
        if (!$this->lesCoachTechniques->contains($lesCoachTechnique)) {
            $this->lesCoachTechniques->add($lesCoachTechnique);
            $lesCoachTechnique->addLesCompetencesTechnique($this);
        }

        return $this;
    }

    public function removeLesCoachTechnique(CoachTechnique $lesCoachTechnique): static
    {
        if ($this->lesCoachTechniques->removeElement($lesCoachTechnique)) {
            $lesCoachTechnique->removeLesCompetencesTechnique($this);
        }

        return $this;
    }
}
