<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MemberRepository::class)]
#[ORM\Table(name: '`member`')]
class Member
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 60)]
    private ?string $name = null;

    #[ORM\Column(length: 64)]
    private ?string $authToken = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isAdmin = null;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Loadout::class)]
    private Collection $loadouts;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Ship::class)]
    private Collection $ships;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Preset::class)]
    private Collection $presets;

    public function __construct()
    {
        $this->loadouts = new ArrayCollection();
        $this->ships = new ArrayCollection();
        $this->presets = new ArrayCollection();
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

    public function getAuthToken(): ?string
    {
        return $this->authToken;
    }

    public function setAuthToken(string $authToken): static
    {
        $this->authToken = $authToken;

        return $this;
    }

    public function isItAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(?bool $isAdmin): static
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * @return Collection<int, Loadout>
     */
    public function getLoadouts(): Collection
    {
        return $this->loadouts;
    }

    public function addLoadout(Loadout $loadout): static
    {
        if (!$this->loadouts->contains($loadout)) {
            $this->loadouts->add($loadout);
            $loadout->setOwner($this);
        }

        return $this;
    }

    public function removeLoadout(Loadout $loadout): static
    {
        if ($this->loadouts->removeElement($loadout)) {
            // set the owning side to null (unless already changed)
            if ($loadout->getOwner() === $this) {
                $loadout->setOwner(null);
            }
        }

        return $this;
    }

    public function getFleet(): ?Fleet
    {
        return $this->fleet;
    }

    public function setFleet(?Fleet $fleet): static
    {
        // unset the owning side of the relation if necessary
        if ($fleet === null && $this->fleet !== null) {
            $this->fleet->setOwner(null);
        }

        // set the owning side of the relation if necessary
        if ($fleet !== null && $fleet->getOwner() !== $this) {
            $fleet->setOwner($this);
        }

        $this->fleet = $fleet;

        return $this;
    }

    /**
     * @return Collection<int, Ship>
     */
    public function getShips(): Collection
    {
        return $this->ships;
    }

    public function addShip(Ship $ship): static
    {
        if (!$this->ships->contains($ship)) {
            $this->ships->add($ship);
            $ship->setOwner($this);
        }

        return $this;
    }

    public function removeShip(Ship $ship): static
    {
        if ($this->ships->removeElement($ship)) {
            // set the owning side to null (unless already changed)
            if ($ship->getOwner() === $this) {
                $ship->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Preset>
     */
    public function getPresets(): Collection
    {
        return $this->presets;
    }

    public function addPreset(Preset $preset): static
    {
        if (!$this->presets->contains($preset)) {
            $this->presets->add($preset);
            $preset->setOwner($this);
        }

        return $this;
    }

    public function removePreset(Preset $preset): static
    {
        if ($this->presets->removeElement($preset)) {
            // set the owning side to null (unless already changed)
            if ($preset->getOwner() === $this) {
                $preset->setOwner(null);
            }
        }

        return $this;
    }
}
