<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetitionInfoRepository")
 */
class CompetitionInfo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $CompId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CurrentChamp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $MostChamp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $RelegationTo;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $TeamsBr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $MostApp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $TopScorer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $GoalsPerMatch;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $HomeWins;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Tie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AwayWins;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $YellowCard;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $RedCard;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompId(): ?int
    {
        return $this->CompId;
    }

    public function setCompId(int $CompId): self
    {
        $this->CompId = $CompId;

        return $this;
    }

    public function getCurrentChamp(): ?string
    {
        return $this->CurrentChamp;
    }

    public function setCurrentChamp(string $CurrentChamp): self
    {
        $this->CurrentChamp = $CurrentChamp;

        return $this;
    }

    public function getMostChamp(): ?string
    {
        return $this->MostChamp;
    }

    public function setMostChamp(string $MostChamp): self
    {
        $this->MostChamp = $MostChamp;

        return $this;
    }

    public function getRelegationTo(): ?string
    {
        return $this->RelegationTo;
    }

    public function setRelegationTo(string $RelegationTo): self
    {
        $this->RelegationTo = $RelegationTo;

        return $this;
    }

    public function getTeamsBr(): ?string
    {
        return $this->TeamsBr;
    }

    public function setTeamsBr(string $TeamsBr): self
    {
        $this->TeamsBr = $TeamsBr;

        return $this;
    }

    public function getMostApp(): ?string
    {
        return $this->MostApp;
    }

    public function setMostApp(string $MostApp): self
    {
        $this->MostApp = $MostApp;

        return $this;
    }

    public function getTopScorer(): ?string
    {
        return $this->TopScorer;
    }

    public function setTopScorer(string $TopScorer): self
    {
        $this->TopScorer = $TopScorer;

        return $this;
    }

    public function getGoalsPerMatch(): ?string
    {
        return $this->GoalsPerMatch;
    }

    public function setGoalsPerMatch(string $GoalsPerMatch): self
    {
        $this->GoalsPerMatch = $GoalsPerMatch;

        return $this;
    }

    public function getHomeWins(): ?string
    {
        return $this->HomeWins;
    }

    public function setHomeWins(string $HomeWins): self
    {
        $this->HomeWins = $HomeWins;

        return $this;
    }

    public function getTie(): ?string
    {
        return $this->Tie;
    }

    public function setTie(string $Tie): self
    {
        $this->Tie = $Tie;

        return $this;
    }

    public function getAwayWins(): ?string
    {
        return $this->AwayWins;
    }

    public function setAwayWins(string $AwayWins): self
    {
        $this->AwayWins = $AwayWins;

        return $this;
    }

    public function getYellowCard(): ?string
    {
        return $this->YellowCard;
    }

    public function setYellowCard(string $YellowCard): self
    {
        $this->YellowCard = $YellowCard;

        return $this;
    }

    public function getRedCard(): ?string
    {
        return $this->RedCard;
    }

    public function setRedCard(string $RedCard): self
    {
        $this->RedCard = $RedCard;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }
}
