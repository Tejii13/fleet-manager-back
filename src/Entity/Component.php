<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ComponentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComponentRepository::class)]
#[ApiResource()]
class Component
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $category = null;

    #[ORM\Column(length: 30)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $size = null;

    #[ORM\ManyToMany(targetEntity: Loadout::class, inversedBy: 'components')]
    private Collection $forLoadout;

    public function __construct()
    {
        $this->forLoadout = new ArrayCollection();
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
    public function getForLoadout(): Collection
    {
        return $this->forLoadout;
    }

    public function addForLoadout(Loadout $forLoadout): static
    {
        if (!$this->forLoadout->contains($forLoadout)) {
            $this->forLoadout->add($forLoadout);
        }

        return $this;
    }

    public function removeForLoadout(Loadout $forLoadout): static
    {
        $this->forLoadout->removeElement($forLoadout);

        return $this;
    }
}
