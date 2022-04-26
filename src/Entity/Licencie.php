<?php

namespace App\Entity;

use App\Repository\LicencieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=LicencieRepository::class)
 */
class Licencie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=11, scale=0, name="numlicence")
     */
    private $numLicence;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $prenom;

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
     * @ORM\Column(type="string", length=100)
     * @Assert\Email(
     *      message="Le mail n'est pas valide."
     * )
     */
    private $mail;

    /**
     * @ORM\Column(type="date", name="dateadhesion")
     */
    private $dateAdhesion;

    /**
     * @ORM\ManyToOne(targetEntity=Club::class, inversedBy="lesLicencies")
     * @ORM\JoinColumn(nullable=false, name="idclub")
     */
    private $leClub;

    /**
     * @ORM\ManyToOne(targetEntity=Qualite::class, inversedBy="lesLicencies")
     * @ORM\JoinColumn(nullable=false, name="idqualite")
     */
    private $laQualite;
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumLicence(): ?string
    {
        return $this->numLicence;
    }

    public function setNumLicence(string $numLicence): self
    {
        $this->numLicence = $numLicence;

        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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

    public function getDateAdhesion(): ?\DateTimeInterface
    {
        return $this->dateAdhesion;
    }

    public function setDateAdhesion(\DateTimeInterface $dateAdhesion): self
    {
        $this->dateAdhesion = $dateAdhesion;

        return $this;
    }

    public function getLeClub(): ?Club
    {
        return $this->leClub;
    }

    public function setLeClub(?Club $leClub): self
    {
        $this->leClub = $leClub;

        return $this;
    }

    public function getLaQualite(): ?Qualite
    {
        return $this->laQualite;
    }

    public function setLaQualite(?Qualite $laQualite): self
    {
        $this->laQualite = $laQualite;

        return $this;
    }
}
