<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource]
#[UniqueEntity('username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Ship::class, cascade: ['remove'])]
    private Collection $ships;

    #[ORM\Column(length: 36)]
    private ?string $auth = null;

    #[ORM\Column]
    private ?bool $verified = null;

    #[ORM\ManyToMany(targetEntity: Organizations::class, inversedBy: 'users')]
    private Collection $organizations;

    #[ORM\ManyToOne(inversedBy: 'leader')]
    private ?Organizations $organization_leader = null;

    #[ORM\ManyToOne]
    private ?Organizations $main_org = null;

    public function __construct()
    {
        $this->ships = new ArrayCollection();
        $this->organizations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Ship>
     */
    public function getShips(): Collection
    {
        return $this->ships;
    }

    public function addShip(Ship $ship): static
    {
        if (!$this->ships->contains($ship)) {
            $this->ships->add($ship);
            $ship->setOwner($this);
        }

        return $this;
    }

    public function removeShip(Ship $ship): static
    {
        if ($this->ships->removeElement($ship)) {
            // set the owning side to null (unless already changed)
            if ($ship->getOwner() === $this) {
                $ship->setOwner(null);
            }
        }

        return $this;
    }

    public function getAuth(): ?string
    {
        return $this->auth;
    }

    public function setAuth(string $auth): static
    {
        $this->auth = $auth;

        return $this;
    }

    public function isVerified(): ?bool
    {
        return $this->verified;
    }

    public function setVerified(bool $verified): static
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * @return Collection<int, organizations>
     */
    public function getOrganizations(): Collection
    {
        return $this->organizations;
    }

    public function addOrganization(Organizations $organization): static
    {
        if (!$this->organizations->contains($organization)) {
            $this->organizations->add($organization);
        }

        return $this;
    }

    public function removeOrganization(Organizations $organization): static
    {
        $this->organizations->removeElement($organization);

        return $this;
    }

    public function getOrganizationLeader(): ?Organizations
    {
        return $this->organization_leader;
    }

    public function setOrganizationLeader(?Organizations $organization_leader): static
    {
        $this->organization_leader = $organization_leader;

        return $this;
    }

    public function getMainOrg(): ?Organizations
    {
        return $this->main_org;
    }

    public function setMainOrg(?Organizations $main_org): static
    {
        $this->main_org = $main_org;

        return $this;
    }
}
