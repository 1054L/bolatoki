<?php

namespace App\Entity;

use App\Repository\ClasificationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasificationRepository::class)]
class Clasification //Ignorar, en realidad se puede borrar!!
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'clasification', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?championship $championship = null;

    /**
     * @var Collection<int, Player>
     */
    #[ORM\ManyToMany(targetEntity: Player::class, inversedBy: 'clasifications')]
    private Collection $player;

    #[ORM\Column(nullable: true)]
    private ?int $points = null;

    public function __construct()
    {
        $this->player = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChampionship(): ?championship
    {
        return $this->championship;
    }

    public function setChampionship(championship $championship): static
    {
        $this->championship = $championship;

        return $this;
    }

    /**
     * @return Collection<int, Player>
     */
    public function getPlayer(): Collection
    {
        return $this->player;
    }

    public function addPlayer(Player $player): static
    {
        if (!$this->player->contains($player)) {
            $this->player->add($player);
        }

        return $this;
    }

    public function removePlayer(Player $player): static
    {
        $this->player->removeElement($player);

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(?int $points): static
    {
        $this->points = $points;

        return $this;
    }
}
