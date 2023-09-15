<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ShipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column]
    private ?int $size = null;

    #[ORM\OneToMany(mappedBy: 'for_ship', targetEntity: Loadout::class)]
    private Collection $loadouts;

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

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): static
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
}
