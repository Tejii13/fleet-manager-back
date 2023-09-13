<?php

namespace App\Entity;

use App\Repository\PresetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PresetRepository::class)]
class Preset
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'presets')]
    private ?Member $owner = null;

    #[ORM\ManyToMany(targetEntity: Components::class, inversedBy: 'presets')]
    private Collection $isComposedBy;

    #[ORM\ManyToOne(inversedBy: 'presets')]
    private ?Ship $forShip = null;

    public function __construct()
    {
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

    public function getForShip(): ?Ship
    {
        return $this->forShip;
    }

    public function setForShip(?Ship $forShip): static
    {
        $this->forShip = $forShip;

        return $this;
    }
}
