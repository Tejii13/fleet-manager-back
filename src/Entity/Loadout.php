<?php

namespace App\Entity;

use App\Repository\LoadoutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoadoutRepository::class)]
class Loadout
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $coolers = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $powerPlant = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $shields = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $quantumDrive = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $missiles = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $turrets = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $utilityItem = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $weapons = null;

    #[ORM\ManyToOne(inversedBy: 'loadouts')]
    private ?Member $owner = null;

    #[ORM\ManyToOne(inversedBy: 'associatedLoadout')]
    private ?Ship $ship = null;

    #[ORM\ManyToMany(targetEntity: Components::class, mappedBy: 'composes')]
    private Collection $components;

    #[ORM\ManyToMany(targetEntity: Components::class, inversedBy: 'loadouts')]
    private Collection $isComposedBy;

    public function __construct()
    {
        $this->components = new ArrayCollection();
        $this->isComposedBy = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

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

    public function getCoolers(): ?string
    {
        return $this->coolers;
    }

    public function setCoolers(?string $coolers): static
    {
        $this->coolers = $coolers;

        return $this;
    }

    public function getPowerPlant(): ?string
    {
        return $this->powerPlant;
    }

    public function setPowerPlant(?string $powerPlant): static
    {
        $this->powerPlant = $powerPlant;

        return $this;
    }

    public function getShields(): ?string
    {
        return $this->shields;
    }

    public function setShields(?string $shields): static
    {
        $this->shields = $shields;

        return $this;
    }

    public function getQuantumDrive(): ?string
    {
        return $this->quantumDrive;
    }

    public function setQuantumDrive(?string $quantumDrive): static
    {
        $this->quantumDrive = $quantumDrive;

        return $this;
    }

    public function getMissiles(): ?string
    {
        return $this->missiles;
    }

    public function setMissiles(?string $missiles): static
    {
        $this->missiles = $missiles;

        return $this;
    }

    public function getTurrets(): ?string
    {
        return $this->turrets;
    }

    public function setTurrets(?string $turrets): static
    {
        $this->turrets = $turrets;

        return $this;
    }

    public function getUtilityItem(): ?string
    {
        return $this->utilityItem;
    }

    public function setUtilityItem(?string $utilityItem): static
    {
        $this->utilityItem = $utilityItem;

        return $this;
    }

    public function getWeapons(): ?string
    {
        return $this->weapons;
    }

    public function setWeapons(?string $weapons): static
    {
        $this->weapons = $weapons;

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

    public function getShip(): ?Ship
    {
        return $this->ship;
    }

    public function setShip(?Ship $ship): static
    {
        $this->ship = $ship;

        return $this;
    }

    /**
     * @return Collection<int, Components>
     */
    public function getComponents(): Collection
    {
        return $this->components;
    }

    public function addComponent(Components $component): static
    {
        if (!$this->components->contains($component)) {
            $this->components->add($component);
            $component->addCompose($this);
        }

        return $this;
    }

    public function removeComponent(Components $component): static
    {
        if ($this->components->removeElement($component)) {
            $component->removeCompose($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Components>
     */
    public function getIsComposedBy(): Collection
    {
        return $this->isComposedBy;
    }

    public function addIsComposedBy(Components $isComposedBy): static
    {
        if (!$this->isComposedBy->contains($isComposedBy)) {
            $this->isComposedBy->add($isComposedBy);
        }

        return $this;
    }

    public function removeIsComposedBy(Components $isComposedBy): static
    {
        $this->isComposedBy->removeElement($isComposedBy);

        return $this;
    }
}
