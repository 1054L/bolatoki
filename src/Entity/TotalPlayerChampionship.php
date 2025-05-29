<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TotalPlayerChampionshipRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['TotalPlayerChampionshipRepository:read']],
    denormalizationContext: ['groups' => ['TotalPlayerChampionshipRepository:write']]
)]
#[ORM\Entity(repositoryClass: TotalPlayerChampionshipRepository::class)]
class TotalPlayerChampionship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['championship:read', 'game:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['championship:read', 'game:read'])]
    private ?int $total = null;

    #[ORM\ManyToOne(inversedBy: 'totalPlayerChampionships')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['championship:read', 'game:read'])]
    private ?Player $player = null;

    #[ORM\ManyToOne(inversedBy: 'totalPlayerChampionships')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Championship $championship = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): static
    {
        $this->player = $player;

        return $this;
    }

    public function getChampionship(): ?Championship
    {
        return $this->championship;
    }

    public function setChampionship(?Championship $championship): static
    {
        $this->championship = $championship;

        return $this;
    }
}
