<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Exception\NotAllowedRoleException;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 * @ORM\Table(name="role",indexes={@ORM\Index(name="role_label_idx", columns={"label"})})
 */
class Role
{
    public const ROLE_USER = 'ROLE_USER';
    
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;
    
    public function __construct($label)
    {
        $this->setLabel($label);
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getLabel()
    {
        return $this->label;
    }
    
    public function setLabel($label)
    {
        $allowedRoles = [self::ROLE_USER, self::ROLE_ADMIN];
        if (!in_array($label, $allowedRoles)) {
            throw new NotAllowedRoleException($allowedRoles, $label);
        }
        
        $this->label = $label;
        return $this;
    }
}
