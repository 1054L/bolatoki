<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\StakeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource()]
#[ORM\Entity(repositoryClass: StakeRepository::class)]
class Stake
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $runTest = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $runOne = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $runTwo = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $runThree = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $runFour = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $runFive = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $runSix = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $runSeven = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $runEight = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $total = null;

    #[ORM\ManyToOne(inversedBy: 'stakes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Player $player = null;

    #[ORM\ManyToOne(inversedBy: 'stakes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Game $game = null;

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
}
