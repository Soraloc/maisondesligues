<?php

namespace App\Entity;

use App\Repository\VacationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=VacationRepository::class)
 */
class Vacation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", name="dateheuredebut")
     * @Assert\GreaterThanOrEqual("today")(
     *      message="La date doit être d'au moins aujourd'hui"
     *      )
     */
    private $dateHeureDebut;

    /**
     * @ORM\Column(type="datetime", name="dateheurefin")
     * @Assert\GreaterThanOrEqual("today")(
     *      message="La date doit être d'au moins aujourd'hui"
     *      )
     */
    private $dateHeureFin;

    /**
     * @ORM\ManyToOne(targetEntity=Atelier::class, inversedBy="lesVacations")
     * @ORM\JoinColumn(nullable=false, name="idatelier")
     */
    private $atelier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateHeureDebut(): ?\DateTimeInterface
    {
        return $this->dateHeureDebut;
    }

    public function setDateHeureDebut(\DateTimeInterface $dateHeureDebut): self
    {
        $this->dateHeureDebut = $dateHeureDebut;

        return $this;
    }

    public function getDateHeureFin(): ?\DateTimeInterface
    {
        return $this->dateHeureFin;
    }

    public function setDateHeureFin(\DateTimeInterface $dateHeureFin): self
    {
        $this->dateHeureFin = $dateHeureFin;

        return $this;
    }

    public function getAtelier(): ?Atelier
    {
        return $this->atelier;
    }

    public function setAtelier(?Atelier $atelier): self
    {
        $this->atelier = $atelier;

        return $this;
    }
}
