<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OrganizationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrganizationsRepository::class)]
#[ApiResource]
class Organizations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 60)]
    private ?string $sid = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'organizations')]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'organization_leader', targetEntity: user::class, cascade: ['persist'])]
    private Collection $leader;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->leader = new ArrayCollection();
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

    public function getSid(): ?string
    {
        return $this->sid;
    }

    public function setSid(string $sid): static
    {
        $this->sid = $sid;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addOrganization($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeOrganization($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, user>
     */
    public function getLeader(): Collection
    {
        return $this->leader;
    }

    public function addLeader(user $leader): static
    {
        if (!$this->leader->contains($leader)) {
            $this->leader->add($leader);
            $leader->setOrganizationLeader($this);
        }

        return $this;
    }

    public function removeLeader(user $leader): static
    {
        if ($this->leader->removeElement($leader)) {
            // set the owning side to null (unless already changed)
            if ($leader->getOrganizationLeader() === $this) {
                $leader->setOrganizationLeader(null);
            }
        }

        return $this;
    }
}
