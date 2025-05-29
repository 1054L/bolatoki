<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\StakeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ApiResource(
    normalizationContext: ['groups' => ['game:read']],
    operations: [
        new GetCollection(order: ['position' => 'ASC']),
        new Get(),
        new Post(),
        new Patch(),
        new Put(),
        new Delete()
    ]
)]
#[ORM\Entity(repositoryClass: StakeRepository::class)]
class Stake
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['game:read'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    #[Groups(['game:read'])]
    private ?int $runTest = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    #[Groups(['game:read'])]
    private ?int $runOne = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    #[Groups(['game:read'])]
    private ?int $runTwo = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    #[Groups(['game:read'])]
    private ?int $runThree = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    #[Groups(['game:read'])]
    private ?int $runFour = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    #[Groups(['game:read'])]
    private ?int $runFive = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    #[Groups(['game:read'])]
    private ?int $runSix = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    #[Groups(['game:read'])]
    private ?int $runSeven = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    #[Groups(['game:read'])]
    private ?int $runEight = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    #[Groups(['game:read'])]
    private ?int $total = null;

    #[ORM\ManyToOne(inversedBy: 'stakes', fetch: 'EAGER')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['game:read'])]
    #[MaxDepth(1)]
    private ?Player $player = null;

    #[ORM\ManyToOne(inversedBy: 'stakes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Game $game = null;

    #[ORM\Column(type: "integer")]
    #[Groups(['game:read'])]
    private ?int $position = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRunTest(): ?int
    {
        return $this->runTest;
    }

    public function setRunTest(?int $runTest): static
    {
        $this->runTest = $runTest;

        return $this;
    }

    public function getRunOne(): ?int
    {
        return $this->runOne;
    }

    public function setRunOne(?int $runOne): static
    {
        $this->runOne = $runOne;

        return $this;
    }

    public function getRunTwo(): ?int
    {
        return $this->runTwo;
    }

    public function setRunTwo(?int $runTwo): static
    {
        $this->runTwo = $runTwo;

        return $this;
    }

    public function getRunThree(): ?int
    {
        return $this->runThree;
    }

    public function setRunThree(?int $runThree): static
    {
        $this->runThree = $runThree;

        return $this;
    }

    public function getRunFour(): ?int
    {
        return $this->runFour;
    }

    public function setRunFour(?int $runFour): static
    {
        $this->runFour = $runFour;

        return $this;
    }

    public function getRunFive(): ?int
    {
        return $this->runFive;
    }

    public function setRunFive(?int $runFive): static
    {
        $this->runFive = $runFive;

        return $this;
    }

    public function getRunSix(): ?int
    {
        return $this->runSix;
    }

    public function setRunSix(?int $runSix): static
    {
        $this->runSix = $runSix;

        return $this;
    }

    public function getRunSeven(): ?int
    {
        return $this->runSeven;
    }

    public function setRunSeven(?int $runSeven): static
    {
        $this->runSeven = $runSeven;

        return $this;
    }

    public function getRunEight(): ?int
    {
        return $this->runEight;
    }

    public function setRunEight(?int $runEight): static
    {
        $this->runEight = $runEight;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(?int $total): static
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

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): static
    {
        $this->game = $game;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): self
    {
        $this->position = $position;
        return $this;
    }
}
