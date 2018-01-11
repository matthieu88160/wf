<?php
namespace Model;

class User
{
    private $id;
    protected $roles = [];
    protected $password;
    protected $salt;
    protected $username;
    
    public function getId()
    {
        return $this->id;
    }

    public function getRoles()
    {
        $roles = array_map([$this, 'roleToLabel'], $this->roles);
        
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
}

