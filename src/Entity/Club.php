<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClubRepository::class)
 */
class Club
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $adresse1;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $adresse2;

    /**
     * @ORM\Column(type="string", length=5, options={"fixed":true})     
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=14, options={"fixed":true})
     */
    private $tel;

    /**
     * @ORM\OneToMany(targetEntity=Licencie::class, mappedBy="leClub")
     */
    private $lesLicencies;

    public function __construct()
    {
        $this->lesLicencies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse1(): ?string
    {
        return $this->adresse1;
    }

    public function setAdresse1(string $adresse1): self
    {
        $this->adresse1 = $adresse1;

        return $this;
    }

    public function getAdresse2(): ?string
    {
        return $this->adresse2;
    }

    public function setAdresse2(?string $adresse2): self
    {
        $this->adresse2 = $adresse2;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * @return Collection<int, Licencie>
     */
    public function getLesLicencies(): Collection
    {
        return $this->lesLicencies;
    }

    public function addLesLicency(Licencie $lesLicency): self
    {
        if (!$this->lesLicencies->contains($lesLicency)) {
            $this->lesLicencies[] = $lesLicency;
            $lesLicency->setLeClub($this);
        }

        return $this;
    }

    public function removeLesLicency(Licencie $lesLicency): self
    {
        if ($this->lesLicencies->removeElement($lesLicency)) {
            // set the owning side to null (unless already changed)
            if ($lesLicency->getLeClub() === $this) {
                $lesLicency->setLeClub(null);
            }
        }

        return $this;
    }
}
