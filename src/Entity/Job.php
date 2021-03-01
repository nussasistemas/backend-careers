<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JobRepository::class)
 */
class Job
{
    const STATUS_VISIBLE = 'visible';
    const STATUS_INVISIBLE = 'invisible';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=256)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=10000)
     */
    private $description;

    /** 
     * @ORM\Column(type="string", columnDefinition="ENUM('visible', 'invisible')") 
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $workplace;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $salary;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        if (!in_array($status, array(self::STATUS_VISIBLE, self::STATUS_INVISIBLE))) {
            throw new \InvalidArgumentException("Invalid status");
        }
        $this->status = $status;
        
        return $this; 
    }

    public function getWorkplace(): ?string
    {
        return $this->workplace;
    }

    public function setWorkplace(?string $workplace): self
    {
        $this->workplace = $workplace;

        return $this;
    }

    public function getSalary(): ?string
    {
        return $this->salary;
    }

    public function setSalary(?string $salary): self
    {
        $this->salary = $salary;

        return $this;
    }
}
