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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTarifNuitee(): ?int
    {
        return $this->tarifNuitee;
    }

    public function setTarifNuitee(int $tarifNuitee): self
    {
        $this->tarifNuitee = $tarifNuitee;

        return $this;
    }
}
