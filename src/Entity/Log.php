<?php

namespace App\Entity;

use App\Repository\LogRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LogRepository::class)
 */
class Log
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $login;

    /**
     * @ORM\Column(type="integer")
     */
    private $numLicence;

    /**
     * @ORM\Column(type="date")
     */
    private $dateConnexion;

    /**
     * @ORM\Column(type="string", length=13)
     */
    private $adresseIP;

    /**
     * @ORM\Column(type="boolean")
     */
    private $connexionRouE;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codeErreur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getNumLicence(): ?int
    {
        return $this->numLicence;
    }

    public function setNumLicence(int $numLicence): self
    {
        $this->numLicence = $numLicence;

        return $this;
    }

    public function getDateConnexion(): ?\DateTimeInterface
    {
        return $this->dateConnexion;
    }

    public function setDateConnexion(\DateTimeInterface $dateConnexion): self
    {
        $this->dateConnexion = $dateConnexion;

        return $this;
    }

    public function getAdresseIP(): ?string
    {
        return $this->adresseIP;
    }

    public function setAdresseIP(string $adresseIP): self
    {
        $this->adresseIP = $adresseIP;

        return $this;
    }

    public function getConnexionRouE(): ?bool
    {
        return $this->connexionRouE;
    }

    public function setConnexionRouE(bool $connexionRouE): self
    {
        $this->connexionRouE = $connexionRouE;

        return $this;
    }

    public function getCodeErreur(): ?string
    {
        return $this->codeErreur;
    }

    public function setCodeErreur(string $codeErreur): self
    {
        $this->codeErreur = $codeErreur;

        return $this;
    }
}
