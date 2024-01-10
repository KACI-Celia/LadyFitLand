<?php

namespace App\Entity;

use App\Repository\EquipementsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipementsRepository::class)]
class Equipements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $libelleEquipement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleEquipement(): ?string
    {
        return $this->libelleEquipement;
    }

    public function setLibelleEquipement(?string $libelleEquipement): static
    {
        $this->libelleEquipement = $libelleEquipement;

        return $this;
    }
}
