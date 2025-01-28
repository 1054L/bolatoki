<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource()]
#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(iris: ["https://schema.org/id"])]
    private ?Format $format = null;

    /**
     * @var Collection<int, Stake>
     */
    #[ORM\OneToMany(targetEntity: Stake::class, mappedBy: 'game')]
    private Collection $stakes;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(iris: ["https://schema.org/id"])]
    private ?Field $field = null;

    /**
     * @var Collection<int, Championship>
     */
    #[ORM\ManyToMany(targetEntity: Championship::class, inversedBy: 'games')]
    #[ApiProperty(iris: ["https://schema.org/id"])]
    private Collection $championships;

    public function __construct()
    {
        $this->stakes = new ArrayCollection();
        $this->championships = new ArrayCollection();
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getFormat(): ?Format
    {
        return $this->format;
    }

    public function setFormat(Format $format = null): static
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @return Collection<int, Stake>
     */
    public function getStakes(): Collection
    {
        return $this->stakes;
    }

    public function addStake(Stake $stake): static
    {
        if (!$this->stakes->contains($stake)) {
            $this->stakes->add($stake);
            $stake->setGame($this);
        }

        return $this;
    }

    public function removeStake(Stake $stake): static
    {
        if ($this->stakes->removeElement($stake)) {
            // set the owning side to null (unless already changed)
            if ($stake->getGame() === $this) {
                $stake->setGame(null);
            }
        }

        return $this;
    }

    public function getField(): ?Field
    {
        return $this->field;
    }

    public function setField(?Field $field): static
    {
        $this->field = $field;

        return $this;
    }

    /**
     * @return Collection<int, Championship>
     */
    public function getChampionship(): Collection
    {
        return $this->championships;
    }

    public function addChampionship(Championship $championships): static
    {
        if (!$this->championships->contains($championships)) {
            $this->championships->add($championships);
        }

        return $this;
    }

    public function removeChampionship(Championship $championships): static
    {
        $this->championships->removeElement($championships);

        return $this;
    }
}
