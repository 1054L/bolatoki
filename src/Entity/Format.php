<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\FormatRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['format:read', 'game:read']],
    denormalizationContext: ['groups' => ['format:write']]
)]
#[ORM\Entity(repositoryClass: FormatRepository::class)]
class Format
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['game:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['game:read'])]
    private ?string $name = null;

    #[ORM\Column]
    #[Groups(['game:read'])]
    private ?bool $testrun = null;

    #[ORM\Column]
    #[Groups(['game:read'])]
    private ?int $numRuns = null;

    #[ORM\Column]
    #[Groups(['game:read'])]
    private ?bool $removeMinor = null;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\ManyToMany(targetEntity: Game::class, mappedBy: 'championship')]
    private Collection $games;

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

    public function isTestrun(): ?bool
    {
        return $this->testrun;
    }

    public function setTestrun(bool $testrun): static
    {
        $this->testrun = $testrun;

        return $this;
    }

    public function getNumRuns(): ?int
    {
        return $this->numRuns;
    }

    public function setNumRuns(int $numRuns): static
    {
        $this->numRuns = $numRuns;

        return $this;
    }

    public function isRemoveMinor(): ?bool
    {
        return $this->removeMinor;
    }

    public function setRemoveMinor(bool $removeMinor): static
    {
        $this->removeMinor = $removeMinor;

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
            $game->setFormat($this);
        }

        return $this;
    }

    public function removeGame(Game $game): static
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getFormat() === $this) {
                $game->setFormat(null);
            }
        }

        return $this;
    }
}
