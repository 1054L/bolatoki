<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ChampionshipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource()]
#[ORM\Entity(repositoryClass: ChampionshipRepository::class)]
class Championship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\ManyToMany(targetEntity: Game::class, mappedBy: 'championship')]
    private Collection $games;

    /**
     * @var Collection<int, TotalPlayerChampionship>
     */
    #[ORM\OneToMany(targetEntity: TotalPlayerChampionship::class, mappedBy: 'championships')]
    private Collection $totalPlayerChampionships;

    #[ORM\OneToOne(mappedBy: 'championship', cascade: ['persist', 'remove'])]
    private ?Clasification $clasification = null;

    #[ORM\ManyToOne]
    private ?pointformat $pointformat = null;

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

    public function getPointformat(): ?pointformat
    {
        return $this->pointformat;
    }

    public function setPointformat(?pointformat $pointformat): static
    {
        $this->pointformat = $pointformat;

        return $this;
    }
}
