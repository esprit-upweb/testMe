<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
{
  

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nsc;
    
  
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=Classroom::class, inversedBy="students" )
     * @ORM\JoinColumn(nullable=false)
     */
    private $Classroom;

    /**
     * @ORM\ManyToMany(targetEntity=Club::class, mappedBy="students")
     */
    private $clubs;

    public function __construct()
    {
        $this->clubs = new ArrayCollection();
    }


   

    public function getNsc(): ?string
    {
        return $this->nsc;
    }

    public function setNsc(?string $nsc): self
    {
        $this->nsc = $nsc;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getClassroom(): ?Classroom
    {
        return $this->Classroom;
    }

    public function setClassroom(?Classroom $Classroom): self
    {
        $this->Classroom = $Classroom;

        return $this;
    }

    /**
     * @return Collection|Club[]
     */
    public function getClubs(): Collection
    {
        return $this->clubs;
    }

    public function addClub(Club $club): self
    {
        if (!$this->clubs->contains($club)) {
            $this->clubs[] = $club;
            $club->addStudent($this);
        }

        return $this;
    }

    public function removeClub(Club $club): self
    {
        if ($this->clubs->contains($club)) {
            $this->clubs->removeElement($club);
            $club->removeStudent($this);
        }

        return $this;
    }

}
