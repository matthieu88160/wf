<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\EquatableInterface;
use phpDocumentor\Reflection\Types\Static_;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user",indexes={@ORM\Index(name="user_username_idx", columns={"username"})})
 */
class User implements UserInterface, EquatableInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="users_roles",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     *      )
     */
    private $roles = [];
    
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9])[A-Za-z\d$@$!%*?&]{8,}/",
     *     message="Your password must have at minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character"
     * )
     */
    private $password;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $salt;
    
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $username;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getRoles()
    {
        $roles = [];
        foreach ($this->roles as $role) {
            $roles[] = $this->roleToLabel($role);
        }
        
        if (!in_array(Role::ROLE_USER, $roles)) {
            array_push($roles, Role::ROLE_USER);
        }
        
        return $roles;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function getSalt()
    {
        return $this->salt;
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function setRoles(array $roles)
    {
        $this->roles = [];
        
        array_map([$this, 'addRole'], $roles);
        
        return $this;
    }
    
    public function addRole(Role $role)
    {
        if (!in_array($role, $this->roles)) {
            array_push($this->roles, $role);
        }
        
        return $this;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    
    public function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }
    
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
    
    public function eraseCredentials()
    {
        $this->password = null;
        $this->salt = null;
    }
    
    protected function roleToLabel(Role $role)
    {
        return $role->getLabel();
    }
    
    public function isEqualTo(UserInterface $user)
    {
        $class = User::class;
        if (
            !($user instanceof $class) ||
            $user->getId() !== $this->id ||
            $user->getUsername() !== $this->username
        ) {
            return false;
        }
        
        return true;
    }
}
