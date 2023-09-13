<?php

namespace App\Entity;

use App\Repository\ShipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShipRepository::class)]
class Ship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 32, nullable: true)]
    private ?string $uniqueName = null;

    #[ORM\ManyToOne(inversedBy: 'ships')]
    private ?Member $owner = null;

    #[ORM\OneToMany(mappedBy: 'ship', targetEntity: Loadout::class)]
    private Collection $associatedLoadout;

    #[ORM\OneToMany(mappedBy: 'forShip', targetEntity: Preset::class)]
    private Collection $presets;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Loadout $loadout = null;

    public function __construct()
    {
        $this->associatedLoadout = new ArrayCollection();
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

    public function getUniqueName(): ?string
    {
        return $this->uniqueName;
    }

    public function setUniqueName(string $uniqueName): static
    {
        $this->uniqueName = $uniqueName;

        return $this;
    }

    public function getOwner(): ?Member
    {
        return $this->owner;
    }

    public function setOwner(?Member $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection<int, Loadout>
     */
    public function getAssociatedLoadout(): Collection
    {
        return $this->associatedLoadout;
    }

    public function addAssociatedLoadout(Loadout $associatedLoadout): static
    {
        if (!$this->associatedLoadout->contains($associatedLoadout)) {
            $this->associatedLoadout->add($associatedLoadout);
            $associatedLoadout->setShip($this);
        }

        return $this;
    }

    public function removeAssociatedLoadout(Loadout $associatedLoadout): static
    {
        if ($this->associatedLoadout->removeElement($associatedLoadout)) {
            // set the owning side to null (unless already changed)
            if ($associatedLoadout->getShip() === $this) {
                $associatedLoadout->setShip(null);
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
            $preset->setForShip($this);
        }

        return $this;
    }

    public function removePreset(Preset $preset): static
    {
        if ($this->presets->removeElement($preset)) {
            // set the owning side to null (unless already changed)
            if ($preset->getForShip() === $this) {
                $preset->setForShip(null);
            }
        }

        return $this;
    }

    public function getLoadout(): ?Loadout
    {
        return $this->loadout;
    }

    public function setLoadout(?Loadout $loadout): static
    {
        $this->loadout = $loadout;

        return $this;
    }
}
