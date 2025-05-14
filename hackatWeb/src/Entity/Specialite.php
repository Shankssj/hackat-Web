<?php

namespace App\Entity;

use App\Repository\SpecialiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecialiteRepository::class)]
class Specialite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelleMotivant = null;

    /**
     * @var Collection<int, CoachMotivant>
     */
    #[ORM\ManyToMany(targetEntity: CoachMotivant::class, mappedBy: 'lesSpecialites')]
    private Collection $lesCoachMotivants;

    public function __construct()
    {
        $this->lesCoachMotivants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleMotivant(): ?string
    {
        return $this->libelleMotivant;
    }

    public function setLibelleMotivant(string $libelleMotivant): static
    {
        $this->libelleMotivant = $libelleMotivant;

        return $this;
    }

    /**
     * @return Collection<int, CoachMotivant>
     */
    public function getLesCoachMotivants(): Collection
    {
        return $this->lesCoachMotivants;
    }

    public function addLesCoachMotivant(CoachMotivant $lesCoachMotivant): static
    {
        if (!$this->lesCoachMotivants->contains($lesCoachMotivant)) {
            $this->lesCoachMotivants->add($lesCoachMotivant);
            $lesCoachMotivant->addLesSpecialite($this);
        }

        return $this;
    }

    public function removeLesCoachMotivant(CoachMotivant $lesCoachMotivant): static
    {
        if ($this->lesCoachMotivants->removeElement($lesCoachMotivant)) {
            $lesCoachMotivant->removeLesSpecialite($this);
        }

        return $this;
    }
}
