<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ComponentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComponentsRepository::class)]
#[ApiResource]
class Components
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $category = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $size = null;

    #[ORM\ManyToMany(targetEntity: Loadout::class, inversedBy: 'components')]
    private Collection $loadout;

    public function __construct()
    {
        $this->loadout = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

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
    public function getLoadout(): Collection
    {
        return $this->loadout;
    }

    public function addLoadout(Loadout $loadout): static
    {
        if (!$this->loadout->contains($loadout)) {
            $this->loadout->add($loadout);
        }

        return $this;
    }

    public function removeLoadout(Loadout $loadout): static
    {
        $this->loadout->removeElement($loadout);

        return $this;
    }
}
