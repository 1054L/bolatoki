<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ChampionshipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ApiResource(
    normalizationContext: ['groups' => ['championship:read']],
    denormalizationContext: ['groups' => ['championship:write']]
)]
#[ORM\Entity(repositoryClass: ChampionshipRepository::class)]
class Championship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['championship:read', 'game:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['championship:read', 'championship:write', 'game:read'])]
    private ?string $name = null;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\ManyToMany(targetEntity: Game::class, mappedBy: 'championships')]
    #[Groups(['championship:read'])]
    #[ApiProperty(iris: ["https://schema.org/id"])]
    #[MaxDepth(1)]
    private ?Collection $games = null;
    
    /**
     * @var Collection<int, TotalPlayerChampionship>
     */
    #[ORM\OneToMany(targetEntity: TotalPlayerChampionship::class, mappedBy: 'championship')]
    #[Groups(['championship:read', 'game:read'])]
    #[ApiProperty(iris: ["https://schema.org/id"])]
    #[MaxDepth(1)]
    private ?Collection $totalPlayerChampionships;

    #[ORM\OneToOne(mappedBy: 'championship', cascade: ['persist', 'remove'])]
    #[MaxDepth(1)]
    private ?Clasification $clasification = null;

    /**
     * @Groups({"championship:read"})
     */
    #[ORM\ManyToOne]
    private ?Pointformat $pointformat = null;

    public function __construct()
    {
        $this->games = new ArrayCollection();
        $this->totalPlayerChampionships = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Game>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): static
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->addChampionship($this);
        }

        return $this;
    }

    public function removeGame(Game $game): static
    {
        if ($this->games->removeElement($game)) {
            $game->removeChampionship($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, TotalPlayerChampionship>
     */
    public function getTotalPlayerChampionships(): Collection
    {
        return $this->totalPlayerChampionships;
    }

    public function addTotalPlayerChampionship(TotalPlayerChampionship $totalPlayerChampionship): static
    {
        if (!$this->totalPlayerChampionships->contains($totalPlayerChampionship)) {
            $this->totalPlayerChampionships->add($totalPlayerChampionship);
            $totalPlayerChampionship->setChampionship($this);
        }

        return $this;
    }

    public function removeTotalPlayerChampionship(TotalPlayerChampionship $totalPlayerChampionship): static
    {
        if ($this->totalPlayerChampionships->removeElement($totalPlayerChampionship)) {
            // set the owning side to null (unless already changed)
            if ($totalPlayerChampionship->getChampionship() === $this) {
                $totalPlayerChampionship->setChampionship(null);
            }
        }

        return $this;
    }

    public function getClasification(): ?Clasification
    {
        return $this->clasification;
    }

    public function setClasification(Clasification $clasification): static
    {
        // set the owning side of the relation if necessary
        if ($clasification->getChampionship() !== $this) {
            $clasification->setChampionship($this);
        }

        $this->clasification = $clasification;

        return $this;
    }

    public function getPointformat(): ?Pointformat
    {
        return $this->pointformat;
    }

    public function setPointformat(?Pointformat $pointformat): static
    {
        $this->pointformat = $pointformat;

        return $this;
    }
}
