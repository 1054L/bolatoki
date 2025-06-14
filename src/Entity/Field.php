<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\FieldRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['field:read', 'game:read']],
    denormalizationContext: ['groups' => ['field:write']]
)]
#[ORM\Entity(repositoryClass: FieldRepository::class)]
class Field
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['game:read', 'championship:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['game:read', 'championship:read'])]
    private ?string $name = null;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'field')]
    private Collection $games;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['game:read'])]
    private ?string $lat = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['game:read'])]
    private ?string $lng = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['game:read'])]
    private ?string $image = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $images = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['game:read'])]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $isCovered = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $maintenance = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['game:read'])]
    private ?string $address = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['game:read'])]
    private ?string $cp = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['game:read'])]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['game:read'])]
    private ?string $province = null;

    #[ORM\Column]
    #[Groups(['game:read'])]
    private ?bool $isActive = null;
    
    #[ORM\ManyToOne(targetEntity: Mode::class)]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['field:read', 'field:write'])]
    private ?Mode $mode = null;

    public function __construct()
    {
        $this->games = new ArrayCollection();
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
            $game->setField($this);
        }

        return $this;
    }

    public function removeGame(Game $game): static
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getField() === $this) {
                $game->setField(null);
            }
        }

        return $this;
    }

    public function getLat(): ?string
    {
        return $this->lat;
    }

    public function setLat(?string $lat): static
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?string
    {
        return $this->lng;
    }

    public function setLng(?string $lng): static
    {
        $this->lng = $lng;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(?string $images): static
    {
        $this->images = $images;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isCovered(): ?bool
    {
        return $this->isCovered;
    }

    public function setIsCovered(bool $isCovered): static
    {
        $this->isCovered = $isCovered;

        return $this;
    }

    public function getMaintenance(): ?string
    {
        return $this->maintenance;
    }

    public function setMaintenance(?string $maintenance): static
    {
        $this->maintenance = $maintenance;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(?string $cp): static
    {
        $this->cp = $cp;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;

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

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getMode(): ?Mode
    {
        return $this->mode;
    }

    public function setMode(?Mode $mode): static
    {
        $this->mode = $mode;

        return $this;
    }

}
