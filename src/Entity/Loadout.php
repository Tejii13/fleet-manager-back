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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'loadouts')]
    private ?Ship $forShip = null;

    #[ORM\Column(nullable: true)]
    private ?array $powerPlant = null;

    #[ORM\Column(nullable: true)]
    private ?array $cooler = null;

    #[ORM\Column(nullable: true)]
    private ?array $shield = null;

    #[ORM\Column(nullable: true)]
    private ?array $quantumDrive = null;

    #[ORM\Column(nullable: true)]
    private ?array $weapon = null;

    #[ORM\Column(nullable: true)]
    private ?array $missile = null;

    #[ORM\Column(nullable: true)]
    private ?array $turret = null;

    #[ORM\Column(nullable: true)]
    private ?array $utilityItem = null;

    #[ORM\ManyToMany(targetEntity: Component::class, mappedBy: 'forLoadout')]
    private Collection $components;

    public function __construct()
    {
        $this->components = new ArrayCollection();
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

    public function getForShip(): ?Ship
    {
        return $this->forShip;
    }

    public function setForShip(?Ship $forShip): static
    {
        $this->forShip = $forShip;

        return $this;
    }

    public function getPowerPlant(): ?array
    {
        return $this->powerPlant;
    }

    public function setPowerPlant(?array $powerPlant): static
    {
        $this->powerPlant = $powerPlant;

        return $this;
    }

    public function getCooler(): ?array
    {
        return $this->cooler;
    }

    public function setCooler(?array $cooler): static
    {
        $this->cooler = $cooler;

        return $this;
    }

    public function getShield(): ?array
    {
        return $this->shield;
    }

    public function setShield(?array $shield): static
    {
        $this->shield = $shield;

        return $this;
    }

    public function getQuantumDrive(): ?array
    {
        return $this->quantumDrive;
    }

    public function setQuantumDrive(?array $quantumDrive): static
    {
        $this->quantumDrive = $quantumDrive;

        return $this;
    }

    public function getWeapon(): ?array
    {
        return $this->weapon;
    }

    public function setWeapon(?array $weapon): static
    {
        $this->weapon = $weapon;

        return $this;
    }

    public function getMissile(): ?array
    {
        return $this->missile;
    }

    public function setMissile(?array $missile): static
    {
        $this->missile = $missile;

        return $this;
    }

    public function getTurret(): ?array
    {
        return $this->turret;
    }

    public function setTurret(?array $turret): static
    {
        $this->turret = $turret;

        return $this;
    }

    public function getUtilityItem(): ?array
    {
        return $this->utilityItem;
    }

    public function setUtilityItem(?array $utilityItem): static
    {
        $this->utilityItem = $utilityItem;

        return $this;
    }

    /**
     * @return Collection<int, Component>
     */
    public function getComponents(): Collection
    {
        return $this->components;
    }

    public function addComponent(Component $component): static
    {
        if (!$this->components->contains($component)) {
            $this->components->add($component);
            $component->addForLoadout($this);
        }

        return $this;
    }

    public function removeComponent(Component $component): static
    {
        if ($this->components->removeElement($component)) {
            $component->removeForLoadout($this);
        }

        return $this;
    }
}
