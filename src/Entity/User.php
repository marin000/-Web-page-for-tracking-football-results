<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 *  @UniqueEntity(fields={"name"}, message="There is already an account with this name")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string",length=100)
     */
    private $password;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $result;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comments;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prediction;

    /**
     * @ORM\Column(type="string", length=190,unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Blocked;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\FavClubs", mappedBy="userId")
     */
    private $favClubs;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\FavPlayer", mappedBy="userId")
     */
    private $favPlayers;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\FavMatches", mappedBy="userId")
     */
    private $favMatches;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Predictions", mappedBy="userId")
     */
    private $predictions;

    public function __construct()
    {
        $this->favClubs = new ArrayCollection();
        $this->favPlayers = new ArrayCollection();
        $this->favMatches = new ArrayCollection();
        $this->predictions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getResult(): ?int
    {
        return $this->result;
    }

    public function setResult(?int $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getPrediction(): ?string
    {
        return $this->prediction;
    }

    public function setPrediction(?string $prediction): self
    {
        $this->prediction = $prediction;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBlocked(): ?bool
    {
        return $this->Blocked;
    }

    public function setBlocked(bool $Blocked): self
    {
        $this->Blocked = $Blocked;

        return $this;
    }

    /**
     * @return Collection|FavClubs[]
     */
    public function getFavClubs(): Collection
    {
        return $this->favClubs;
    }

    public function addFavClub(FavClubs $favClub): self
    {
        if (!$this->favClubs->contains($favClub)) {
            $this->favClubs[] = $favClub;
            $favClub->addUserId($this);
        }

        return $this;
    }

    public function removeFavClub(FavClubs $favClub): self
    {
        if ($this->favClubs->contains($favClub)) {
            $this->favClubs->removeElement($favClub);
            $favClub->removeUserId($this);
        }

        return $this;
    }

    /**
     * @return Collection|FavPlayer[]
     */
    public function getFavPlayers(): Collection
    {
        return $this->favPlayers;
    }

    public function addFavPlayer(FavPlayer $favPlayer): self
    {
        if (!$this->favPlayers->contains($favPlayer)) {
            $this->favPlayers[] = $favPlayer;
            $favPlayer->addUserId($this);
        }

        return $this;
    }

    public function removeFavPlayer(FavPlayer $favPlayer): self
    {
        if ($this->favPlayers->contains($favPlayer)) {
            $this->favPlayers->removeElement($favPlayer);
            $favPlayer->removeUserId($this);
        }

        return $this;
    }

    /**
     * @return Collection|FavMatches[]
     */
    public function getFavMatches(): Collection
    {
        return $this->favMatches;
    }

    public function addFavMatch(FavMatches $favMatch): self
    {
        if (!$this->favMatches->contains($favMatch)) {
            $this->favMatches[] = $favMatch;
            $favMatch->addUserId($this);
        }

        return $this;
    }

    public function removeFavMatch(FavMatches $favMatch): self
    {
        if ($this->favMatches->contains($favMatch)) {
            $this->favMatches->removeElement($favMatch);
            $favMatch->removeUserId($this);
        }

        return $this;
    }

    /**
     * @return Collection|Predictions[]
     */
    public function getPredictions(): Collection
    {
        return $this->predictions;
    }

    public function addPrediction(Predictions $prediction): self
    {
        if (!$this->predictions->contains($prediction)) {
            $this->predictions[] = $prediction;
            $prediction->addUserId($this);
        }

        return $this;
    }

    public function removePrediction(Predictions $prediction): self
    {
        if ($this->predictions->contains($prediction)) {
            $this->predictions->removeElement($prediction);
            $prediction->removeUserId($this);
        }

        return $this;
    }
}
