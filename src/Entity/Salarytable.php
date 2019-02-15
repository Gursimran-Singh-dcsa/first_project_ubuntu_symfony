<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SalarytableRepository")
 */
class Salarytable
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
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $salary;

    /**
     * @ORM\Column(type="integer")
     */
    private $pf;

    /**
     * @ORM\Column(type="integer")
     */
    private $takehomepay;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSalary(): ?int
    {
        return $this->salary;
    }

    public function setSalary(int $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getPf(): ?int
    {
        return $this->pf;
    }

    public function setPf(int $pf): self
    {
        $this->pf = $pf;

        return $this;
    }

    public function getTakehomepay(): ?int
    {
        return $this->takehomepay;
    }

    public function setTakehomepay(int $takehomepay): self
    {
        $this->takehomepay = $takehomepay;

        return $this;
    }
}
