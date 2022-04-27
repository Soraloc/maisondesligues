<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ThemeRepository::class)
 */
class Theme
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
     * @ORM\ManyToMany(targetEntity=Atelier::class, mappedBy="lesThemes")
     * @ORM\JoinTable(name="liaisonateliertheme")
     */
    private $lesAteliers;

    public function __construct()
    {
        $this->lesAteliers = new ArrayCollection();
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

    /**
     * @return Collection<int, Atelier>
     */
    public function getLesAteliers(): Collection
    {
        return $this->lesAteliers;
    }

    public function addLesAtelier(Atelier $lesAtelier): self
    {
        if (!$this->lesAteliers->contains($lesAtelier)) {
            $this->lesAteliers[] = $lesAtelier;
            $lesAtelier->addLesTheme($this);
        }

        return $this;
    }

    public function removeLesAtelier(Atelier $lesAtelier): self
    {
        if ($this->lesAteliers->removeElement($lesAtelier)) {
            $lesAtelier->removeLesTheme($this);
        }

        return $this;
    }
}
