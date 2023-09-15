<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\LoadoutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoadoutRepository::class)]
#[ApiResource]
class Loadout
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'loadouts')]
    private ?Ship $for_ship = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?array $power_plants = null;

    #[ORM\Column(nullable: true)]
    private ?array $coolers = null;

    #[ORM\Column(nullable: true)]
    private ?array $shields = null;

    #[ORM\Column(nullable: true)]
    private ?array $quantum_drive = null;

    #[ORM\Column(nullable: true)]
    private ?array $weapons = null;

    #[ORM\Column(nullable: true)]
    private ?array $missiles = null;

    #[ORM\Column(nullable: true)]
    private ?array $turrets = null;

    #[ORM\Column(nullable: true)]
    private ?array $utility_items = null;

    #[ORM\ManyToMany(targetEntity: Components::class, mappedBy: 'loadout')]
    private Collection $components;

    public function __construct()
    {
        $this->components = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getForShip(): ?Ship
    {
        return $this->for_ship;
    }

    public function setForShip(?Ship $for_ship): static
    {
        $this->for_ship = $for_ship;

        return $this;
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

    public function getPowerPlants(): ?array
    {
        return $this->power_plants;
    }

    public function setPowerPlants(?array $power_plants): static
    {
        $this->power_plants = $power_plants;

        return $this;
    }

    public function getCoolers(): ?array
    {
        return $this->coolers;
    }

    public function setCoolers(?array $coolers): static
    {
        $this->coolers = $coolers;

        return $this;
    }

    public function getShields(): ?array
    {
        return $this->shields;
    }

    public function setShields(?array $shields): static
    {
        $this->shields = $shields;

        return $this;
    }

    public function getQuantumDrive(): ?array
    {
        return $this->quantum_drive;
    }

    public function setQuantumDrive(?array $quantum_drive): static
    {
        $this->quantum_drive = $quantum_drive;

        return $this;
    }

    public function getWeapons(): ?array
    {
        return $this->weapons;
    }

    public function setWeapons(?array $weapons): static
    {
        $this->weapons = $weapons;

        return $this;
    }

    public function getMissiles(): ?array
    {
        return $this->missiles;
    }

    public function setMissiles(?array $missiles): static
    {
        $this->missiles = $missiles;

        return $this;
    }

    public function getTurrets(): ?array
    {
        return $this->turrets;
    }

    public function setTurrets(?array $turrets): static
    {
        $this->turrets = $turrets;

        return $this;
    }

    public function getUtilityItems(): ?array
    {
        return $this->utility_items;
    }

    public function setUtilityItems(?array $utility_items): static
    {
        $this->utility_items = $utility_items;

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
            $component->addLoadout($this);
        }

        return $this;
    }

    public function removeComponent(Components $component): static
    {
        if ($this->components->removeElement($component)) {
            $component->removeLoadout($this);
        }

        return $this;
    }
}
