<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuizRepository")
 */
class Quiz
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quest1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quest2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quest3;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quest4;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quest5;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ans1a;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ans1b;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ans1c;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ans2a;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ans2b;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ans2c;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ans3a;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ans3b;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ans3c;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ans4a;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ans4b;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ans4c;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ans5a;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ans5b;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ans5c;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ans1correct;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ans2correct;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ans3correct;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ans4correct;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ans5correct;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $arrUsers = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuest1(): ?string
    {
        return $this->quest1;
    }

    public function setQuest1(string $quest1): self
    {
        $this->quest1 = $quest1;

        return $this;
    }

    public function getQuest2(): ?string
    {
        return $this->quest2;
    }

    public function setQuest2(string $quest2): self
    {
        $this->quest2 = $quest2;

        return $this;
    }

    public function getQuest3(): ?string
    {
        return $this->quest3;
    }

    public function setQuest3(string $quest3): self
    {
        $this->quest3 = $quest3;

        return $this;
    }

    public function getQuest4(): ?string
    {
        return $this->quest4;
    }

    public function setQuest4(string $quest4): self
    {
        $this->quest4 = $quest4;

        return $this;
    }

    public function getQuest5(): ?string
    {
        return $this->quest5;
    }

    public function setQuest5(string $quest5): self
    {
        $this->quest5 = $quest5;

        return $this;
    }

    public function getAns1a(): ?string
    {
        return $this->ans1a;
    }

    public function setAns1a(string $ans1a): self
    {
        $this->ans1a = $ans1a;

        return $this;
    }

    public function getAns1b(): ?string
    {
        return $this->ans1b;
    }

    public function setAns1b(string $ans1b): self
    {
        $this->ans1b = $ans1b;

        return $this;
    }

    public function getAns1c(): ?string
    {
        return $this->ans1c;
    }

    public function setAns1c(string $ans1c): self
    {
        $this->ans1c = $ans1c;

        return $this;
    }

    public function getAns2a(): ?string
    {
        return $this->ans2a;
    }

    public function setAns2a(string $ans2a): self
    {
        $this->ans2a = $ans2a;

        return $this;
    }

    public function getAns2b(): ?string
    {
        return $this->ans2b;
    }

    public function setAns2b(string $ans2b): self
    {
        $this->ans2b = $ans2b;

        return $this;
    }

    public function getAns2c(): ?string
    {
        return $this->ans2c;
    }

    public function setAns2c(string $ans2c): self
    {
        $this->ans2c = $ans2c;

        return $this;
    }

    public function getAns3a(): ?string
    {
        return $this->ans3a;
    }

    public function setAns3a(string $ans3a): self
    {
        $this->ans3a = $ans3a;

        return $this;
    }

    public function getAns3b(): ?string
    {
        return $this->ans3b;
    }

    public function setAns3b(string $ans3b): self
    {
        $this->ans3b = $ans3b;

        return $this;
    }

    public function getAns3c(): ?string
    {
        return $this->ans3c;
    }

    public function setAns3c(string $ans3c): self
    {
        $this->ans3c = $ans3c;

        return $this;
    }

    public function getAns4a(): ?string
    {
        return $this->ans4a;
    }

    public function setAns4a(string $ans4a): self
    {
        $this->ans4a = $ans4a;

        return $this;
    }

    public function getAns4b(): ?string
    {
        return $this->ans4b;
    }

    public function setAns4b(string $ans4b): self
    {
        $this->ans4b = $ans4b;

        return $this;
    }

    public function getAns4c(): ?string
    {
        return $this->ans4c;
    }

    public function setAns4c(string $ans4c): self
    {
        $this->ans4c = $ans4c;

        return $this;
    }

    public function getAns5a(): ?string
    {
        return $this->ans5a;
    }

    public function setAns5a(string $ans5a): self
    {
        $this->ans5a = $ans5a;

        return $this;
    }

    public function getAns5b(): ?string
    {
        return $this->ans5b;
    }

    public function setAns5b(string $ans5b): self
    {
        $this->ans5b = $ans5b;

        return $this;
    }

    public function getAns5c(): ?string
    {
        return $this->ans5c;
    }

    public function setAns5c(string $ans5c): self
    {
        $this->ans5c = $ans5c;

        return $this;
    }

    public function getAns1correct(): ?string
    {
        return $this->ans1correct;
    }

    public function setAns1correct(string $ans1correct): self
    {
        $this->ans1correct = $ans1correct;

        return $this;
    }

    public function getAns2correct(): ?string
    {
        return $this->ans2correct;
    }

    public function setAns2correct(string $ans2correct): self
    {
        $this->ans2correct = $ans2correct;

        return $this;
    }

    public function getAns3correct(): ?string
    {
        return $this->ans3correct;
    }

    public function setAns3correct(string $ans3correct): self
    {
        $this->ans3correct = $ans3correct;

        return $this;
    }

    public function getAns4correct(): ?string
    {
        return $this->ans4correct;
    }

    public function setAns4correct(string $ans4correct): self
    {
        $this->ans4correct = $ans4correct;

        return $this;
    }

    public function getAns5correct(): ?string
    {
        return $this->ans5correct;
    }

    public function setAns5correct(string $ans5correct): self
    {
        $this->ans5correct = $ans5correct;

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

    public function getArrUsers(): ?array
    {
        return $this->arrUsers;
    }

    public function setArrUsers(?array $arrUsers): self
    {
        $this->arrUsers = $arrUsers;

        return $this;
    }
}
