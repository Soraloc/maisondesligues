<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=HotelRepository::class)
 */
class Hotel
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
    private $pnom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse2;

    /**
     * @ORM\Column(type="string", length=5, options={"fixed":true})
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=14, options={"fixed":true})
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Email
     */
    private $mail;

    /**
     * @ORM\OneToMany(targetEntity=Proposer::class, mappedBy="unHotel")
     */
    private $leTarifNuitee;

    public function __construct()
    {
        $this->leTarifNuitee = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPnom(): ?string
    {
        return $this->pnom;
    }

    public function setPnom(string $pnom): self
    {
        $this->pnom = $pnom;

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

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return Collection<int, Proposer>
     */
    public function getLeTarifNuitee(): Collection
    {
        return $this->leTarifNuitee;
    }

    public function addLeTarifNuitee(Proposer $leTarifNuitee): self
    {
        if (!$this->leTarifNuitee->contains($leTarifNuitee)) {
            $this->leTarifNuitee[] = $leTarifNuitee;
            $leTarifNuitee->setUnHotel($this);
        }

        return $this;
    }

    public function removeLeTarifNuitee(Proposer $leTarifNuitee): self
    {
        if ($this->leTarifNuitee->removeElement($leTarifNuitee)) {
            // set the owning side to null (unless already changed)
            if ($leTarifNuitee->getUnHotel() === $this) {
                $leTarifNuitee->setUnHotel(null);
            }
        }

        return $this;
    }
}
