<?php

namespace App\Entity;

use App\Repository\CoachMotivantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoachMotivantRepository::class)]
class CoachMotivant extends Coach
{
    /**
     * @var Collection<int, Specialite>
     */
    #[ORM\ManyToMany(targetEntity: Specialite::class, inversedBy: 'lesCoachMotivants')]
    private Collection $lesSpecialites;

    public function __construct()
    {
        $this->lesSpecialites = new ArrayCollection();
    }

    /**
     * @return Collection<int, Specialite>
     */
    public function getLesSpecialites(): Collection
    {
        return $this->lesSpecialites;
    }

    public function addLesSpecialite(Specialite $lesSpecialite): static
    {
        if (!$this->lesSpecialites->contains($lesSpecialite)) {
            $this->lesSpecialites->add($lesSpecialite);
        }

        return $this;
    }

    public function removeLesSpecialite(Specialite $lesSpecialite): static
    {
        $this->lesSpecialites->removeElement($lesSpecialite);

        return $this;
    }
}
