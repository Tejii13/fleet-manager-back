<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ShipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShipRepository::class)]
#[ApiResource]
class Ship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ships')]
    private ?User $owner = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 32, nullable: true)]
    private ?string $nickname = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $size = null;

    #[ORM\OneToMany(mappedBy: 'for_ship', targetEntity: Loadout::class)]
    private Collection $loadouts;

    #[ORM\Column(length: 50)]
    private ?string $production_status = null;

    #[ORM\Column(length: 50)]
    private ?string $manufacturer = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $max_crew = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $url = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageUrl = null;

    #[ORM\Column(nullable: true)]
    private ?int $cargo_capacity = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $focus = null;

    #[ORM\Column(length: 60)]
    private ?string $owner_username = null;

    public function __construct()
    {
        $this->loadouts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
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

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(?string $nickname): static
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): static
    {
        $this->size = $size;

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
            $loadout->setForShip($this);
        }

        return $this;
    }

    public function removeLoadout(Loadout $loadout): static
    {
        if ($this->loadouts->removeElement($loadout)) {
            // set the owning side to null (unless already changed)
            if ($loadout->getForShip() === $this) {
                $loadout->setForShip(null);
            }
        }

        return $this;
    }

    public function getProductionStatus(): ?string
    {
        return $this->production_status;
    }

    public function setProductionStatus(string $production_status): static
    {
        $this->production_status = $production_status;

        return $this;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): static
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getMaxCrew(): ?int
    {
        return $this->max_crew;
    }

    public function setMaxCrew(?int $max_crew): static
    {
        $this->max_crew = $max_crew;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

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

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getCargoCapacity(): ?int
    {
        return $this->cargo_capacity;
    }

    public function setCargoCapacity(?int $cargo_capacity): static
    {
        $this->cargo_capacity = $cargo_capacity;

        return $this;
    }

    public function getFocus(): ?string
    {
        return $this->focus;
    }

    public function setFocus(?string $focus): static
    {
        $this->focus = $focus;

        return $this;
    }

    public function getOwnerUsername(): ?string
    {
        return $this->owner_username;
    }

    public function setOwnerUsername(string $owner_username): static
    {
        $this->owner_username = $owner_username;

        return $this;
    }
}
