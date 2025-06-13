<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Serializer\Attribute\MaxDepth;

#[ApiResource(
    normalizationContext: ['groups' => ['game:read', 'championship:read']],
    denormalizationContext: ['groups' => ['game:write']],
    operations: [
        new GetCollection(normalizationContext: ['groups' => ['game:list']]),
        new Get(normalizationContext: ['groups' => ['game:read']])
    ]
)]
#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['game:read', 'game:write', 'game:list', 'championship:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['game:read', 'game:write', 'game:list', 'championship:read'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['game:read', 'game:write', 'game:list', 'championship:read'])]
    private ?\DateTimeInterface $date = null;

    // #[ORM\ManyToOne(inversedBy: 'games', fetch: 'EAGER')]
    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(iris: ["https://schema.org/id"])]
    #[Groups(['game:read', 'game:write', 'game:list'])]
    #[MaxDepth(1)]
    private ?Format $format = null;

    /**
     * @var Collection<int, Stake>
     */
    // #[ORM\OneToMany(targetEntity: Stake::class, mappedBy: 'game', fetch: 'EAGER')]
    #[ORM\OneToMany(targetEntity: Stake::class, mappedBy: 'game')]
    #[ORM\OrderBy(['position' => 'ASC'])]
    #[Groups(['game:read', 'game:write'])]
    #[MaxDepth(1)]
    private Collection $stakes;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(iris: ["https://schema.org/id"])]
    #[Groups(['game:read', 'game:write', 'game:list', 'championship:read'])]
    #[MaxDepth(1)]
    private ?Field $field = null;

    /**
     * @var Collection<int, Championship>
     */
    #[ORM\ManyToMany(targetEntity: Championship::class, inversedBy: 'games')]
    #[ApiProperty(iris: ["https://schema.org/id"])]
    #[Groups(['game:read', 'game:list', 'game:write'])]
    #[MaxDepth(1)]
    private ?Collection $championships;

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
    public function getChampionships(): Collection
    {
        return $this->championships;
    }

    public function addChampionship(Championship $championship): static
    {
        if (!$this->championships->contains($championship)) {
            $this->championships->add($championship);
            $championship->addGame($this);
        }

        return $this;
    }

    public function removeChampionship(Championship $championship): static
    {
        if ($this->championships->removeElement($championship)) {
            $championship->removeGame($this);
        }
        return $this;
    }
}
