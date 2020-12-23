<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClubRepository::class)
 */
class Club
{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=50)
     */
    private $REF;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Creation_date;

    /**
     * @ORM\ManyToMany(targetEntity=Student::class, inversedBy="clubs")
     * @ORM\JoinTable(name="clubStudent",
     * joinColumns={@ORM\JoinColumn(name="clubREF", referencedColumnName="ref")},
     * inverseJoinColumns={@ORM\JoinColumn(name="Etudiantnsc", referencedColumnName="nsc")}
     * )
     * 
     */
    private $students;

    public function __construct()
    {
        $this->students = new ArrayCollection();
    } 

   

    public function getREF(): ?string
    {
        return $this->REF;
    }

    public function setREF(string $REF): self
    {
        $this->REF = $REF;

        return $this;
    }

    public function getCreationDate(): ?string
    {
        return $this->Creation_date;
    }

    public function setCreationDate(string $Creation_date): self
    {
        $this->Creation_date = $Creation_date;

        return $this;
    }

    /**
     * @return Collection|Student[]
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->students->contains($student)) {
            $this->students->removeElement($student);
        }

        return $this;
    }

    
}
