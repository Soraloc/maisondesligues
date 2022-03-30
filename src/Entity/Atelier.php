<?php

namespace App\Entity;

use App\Repository\AtelierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AtelierRepository::class)
 */
class Atelier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $libelle;

    /**
     * @ORM\Column(type="integer", name="nbplacesmaxi")
     * @Assert\Positive(
     *      message="Le nombre de places maximum doit être positif."
     *      )
     */
    private $nbPlacesMaxi;

    /**
     * @ORM\OneToMany(targetEntity=Vacation::class, mappedBy="atelier", orphanRemoval=true)
     * @ORM\JoinTable(name="idvacation")
     */
    private $lesVacations;

    /**
     * @ORM\ManyToMany(targetEntity=Theme::class, inversedBy="lesAteliers")
     * @ORM\JoinTable(name="liaisonateliertheme")
     */
    private $lesThemes;

    public function __construct()
    {
        $this->lesVacations = new ArrayCollection();
        $this->lesThemes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getNbPlacesMaxi(): ?int
    {
        return $this->nbPlacesMaxi;
    }

    public function setNbPlacesMaxi(int $nbPlacesMaxi): self
    {
        $this->nbPlacesMaxi = $nbPlacesMaxi;

        return $this;
    }

    /**
     * @return Collection<int, Vacation>
     */
    public function getLesVacations(): Collection
    {
        return $this->lesVacations;
    }

    public function addLesVacation(Vacation $lesVacation): self
    {
        if (!$this->lesVacations->contains($lesVacation)) {
            $this->lesVacations[] = $lesVacation;
            $lesVacation->setAtelier($this);
        }

        return $this;
    }

    public function removeLesVacation(Vacation $lesVacation): self
    {
        if ($this->lesVacations->removeElement($lesVacation)) {
            // set the owning side to null (unless already changed)
            if ($lesVacation->getAtelier() === $this) {
                $lesVacation->setAtelier(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Theme>
     */
    public function getLesThemes(): Collection
    {
        return $this->lesThemes;
    }

    public function addLesThemes(Theme $lesThemes): self
    {
        if (!$this->lesThemes->contains($lesThemes)) {
            $this->lesThemes[] = $lesThemes;
        }

        return $this;
    }

    public function removeLesThemes(Theme $lesThemes): self
    {
        $this->lesThemes->removeElement($lesThemes);

        return $this;
    }
}
