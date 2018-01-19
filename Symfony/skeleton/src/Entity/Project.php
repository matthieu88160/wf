<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 * @ORM\Table(name="project",indexes={@ORM\Index(name="project_name_idx", columns={"name"})})
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     * @Assert\NotBlank()
     */
    private $name;
    
    /**
     * @ORM\Column(type="text", unique=false, nullable=false)
     * @Assert\NotBlank()
     */
    private $description;
    
    /**
     * @ORM\Column(type="datetimetz", nullable=false)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default":false})
     * @Assert\Type("bool")
     */
    private $published = false;
    
    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default":false})
     */
    private $deleted = false;
    
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId() : ?int
    {
        return $this->id;
    }

    public function getName() : ?string
    {
        return $this->name;
    }

    public function getDescription() : ?string
    {
        return $this->description;
    }

    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }

    public function isPublished() : bool
    {
        if ($this->isDeleted()) {
            return false;
        }

        return $this->published;
    }

    public function isDeleted() : bool
    {
        return $this->deleted;
    }

    public function setName(string $name) : Project
    {
        $this->name = $name;
        return $this;
    }

    public function setDescription(string $description) : Project
    {
        $this->description = $description;
        return $this;
    }

    public function setPublished(bool $published) : Project
    {
        $this->published = $published;
        return $this;
    }

    public function setDeleted(bool $deleted) : Project
    {
        $this->deleted = $deleted;
        return $this;
    }

}
