<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PredictionsRepository")
 */
class Predictions
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="predictions")
     */
    private $userId;

    /**
     * @ORM\Column(type="integer")
     */
    private $matchId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pred;

    /**
     * @ORM\Column(type="boolean")
     */
    private $checked;

    public function __construct()
    {
        $this->userId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getUserId(): Collection
    {
        return $this->userId;
    }

    public function addUserId(User $userId): self
    {
        if (!$this->userId->contains($userId)) {
            $this->userId[] = $userId;
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        if ($this->userId->contains($userId)) {
            $this->userId->removeElement($userId);
        }

        return $this;
    }

    public function getMatchId(): ?int
    {
        return $this->matchId;
    }

    public function setMatchId(int $matchId): self
    {
        $this->matchId = $matchId;

        return $this;
    }

    public function getPred(): ?string
    {
        return $this->pred;
    }

    public function setPred(string $pred): self
    {
        $this->pred = $pred;

        return $this;
    }

    public function getChecked(): ?bool
    {
        return $this->checked;
    }

    public function setChecked(bool $checked): self
    {
        $this->checked = $checked;

        return $this;
    }
}
