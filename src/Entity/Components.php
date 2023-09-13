<?php

namespace App\Entity;

use App\Repository\ComponentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComponentsRepository::class)]
class Components
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $category = null;

    #[ORM\Column(length: 30)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $size = null;

    #[ORM\ManyToMany(targetEntity: Loadout::class, inversedBy: 'components')]
    private Collection $composes;

    #[ORM\ManyToMany(targetEntity: Loadout::class, mappedBy: 'isComposedBy')]
    private Collection $loadouts;

    #[ORM\ManyToMany(targetEntity: Preset::class, mappedBy: 'isComposedBy')]
    private Collection $presets;

    public function __construct()
    {
        $this->composes = new ArrayCollection();
        $this->loadouts = new ArrayCollection();
        $this->presets = new ArrayCollection();
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
    public function getComposes(): Collection
    {
        return $this->composes;
    }

    public function addCompose(Loadout $compose): static
    {
        if (!$this->composes->contains($compose)) {
            $this->composes->add($compose);
        }

        return $this;
    }

    public function removeCompose(Loadout $compose): static
    {
        $this->composes->removeElement($compose);

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
            $loadout->addIsComposedBy($this);
        }

        return $this;
    }

    public function removeLoadout(Loadout $loadout): static
    {
        if ($this->loadouts->removeElement($loadout)) {
            $loadout->removeIsComposedBy($this);
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
            $preset->addIsComposedBy($this);
        }

        return $this;
    }

    public function removePreset(Preset $preset): static
    {
        if ($this->presets->removeElement($preset)) {
            $preset->removeIsComposedBy($this);
        }

        return $this;
    }
}
