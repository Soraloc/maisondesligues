<?php

namespace App\Entity;

use App\Repository\NuiteeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NuiteeRepository::class)
 */
class Nuitee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", name="datenuitee")
     */
    private $dateNuitee;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateNuitee(): ?\DateTimeInterface
    {
        return $this->dateNuitee;
    }

    public function setDateNuitee(\DateTimeInterface $dateNuitee): self
    {
        $this->dateNuitee = $dateNuitee;

        return $this;
    }
}
