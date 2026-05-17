<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PointformatRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PointformatRepository::class)]
#[ApiResource]
class Pointformat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['championship:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['championship:read'])]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
