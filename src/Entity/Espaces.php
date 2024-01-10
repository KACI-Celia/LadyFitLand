<?php

namespace App\Entity;

use App\Repository\EspacesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EspacesRepository::class)]
class Espaces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $libelleEspace = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descriptionEspace = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleEspace(): ?string
    {
        return $this->libelleEspace;
    }

    public function setLibelleEspace(?string $libelleEspace): static
    {
        $this->libelleEspace = $libelleEspace;

        return $this;
    }

    public function getDescriptionEspace(): ?string
    {
        return $this->descriptionEspace;
    }

    public function setDescriptionEspace(?string $descriptionEspace): static
    {
        $this->descriptionEspace = $descriptionEspace;

        return $this;
    }
}
