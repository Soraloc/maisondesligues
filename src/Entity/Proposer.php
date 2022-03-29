<?php

namespace App\Entity;

use App\Repository\ProposerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProposerRepository::class)
 */
class Proposer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2, name="tarifnuitee")
     */
    private $tarifNuitee;

    /**
     * @ORM\ManyToOne(targetEntity=Hotel::class, inversedBy="leTarifNuitee")
     * @ORM\JoinColumn(nullable=false, name="hotelid")
     */
    private $unHotel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTarifNuitee(): ?float
    {
        return $this->tarifNuitee;
    }

    public function setTarifNuitee(float $tarifNuitee): self
    {
        $this->tarifNuitee = $tarifNuitee;

        return $this;
    }

    public function getUnHotel(): ?Hotel
    {
        return $this->unHotel;
    }

    public function setUnHotel(?Hotel $unHotel): self
    {
        $this->unHotel = $unHotel;

        return $this;
    }
}
