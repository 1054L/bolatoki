<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource()]
#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $birthdate = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $gender = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $province = null;

    #[ORM\ManyToOne(inversedBy: 'players')]
    private ?Club $club = null;

    #[ORM\OneToOne(inversedBy: 'player', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    /**
     * @var Collection<int, Stake>
     */
    #[ORM\OneToMany(targetEntity: Stake::class, mappedBy: 'player')]
    private Collection $stakes;

    /**
     * @var Collection<int, TotalPlayerChampionship>
     */
    #[ORM\OneToMany(targetEntity: TotalPlayerChampionship::class, mappedBy: 'player')]
    private Collection $totalPlayerChampionships;

    /**
     * @var Collection<int, Clasification>
     */
    #[ORM\ManyToMany(targetEntity: Clasification::class, mappedBy: 'player')]
    private Collection $clasifications;

    public function __construct()
    {
        $this->stakes = new ArrayCollection();
        $this->totalPlayerChampionships = new ArrayCollection();
        $this->clasifications = new ArrayCollection();
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): static
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function setGender(int $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getProvince(): ?string
    {
        return $this->province;
    }

    public function setProvince(?string $province): static
    {
        $this->province = $province;

        return $this;
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): static
    {
        $this->club = $club;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

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
            $stake->setPlayer($this);
        }

        return $this;
    }

    public function removeStake(Stake $stake): static
    {
        if ($this->stakes->removeElement($stake)) {
            // set the owning side to null (unless already changed)
            if ($stake->getPlayer() === $this) {
                $stake->setPlayer(null);
            }
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
            $totalPlayerChampionship->setPlayer($this);
        }

        return $this;
    }

    public function removeTotalPlayerChampionship(TotalPlayerChampionship $totalPlayerChampionship): static
    {
        if ($this->totalPlayerChampionships->removeElement($totalPlayerChampionship)) {
            // set the owning side to null (unless already changed)
            if ($totalPlayerChampionship->getPlayer() === $this) {
                $totalPlayerChampionship->setPlayer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Clasification>
     */
    public function getClasifications(): Collection
    {
        return $this->clasifications;
    }

    public function addClasification(Clasification $clasification): static
    {
        if (!$this->clasifications->contains($clasification)) {
            $this->clasifications->add($clasification);
            $clasification->addPlayer($this);
        }

        return $this;
    }

    public function removeClasification(Clasification $clasification): static
    {
        if ($this->clasifications->removeElement($clasification)) {
            $clasification->removePlayer($this);
        }

        return $this;
    }
}
