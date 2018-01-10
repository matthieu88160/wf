<?php
namespace Model;

class Person
{
    private $id;
    protected $firstname;
    protected $lastname;
    protected $emails = [];
    
    public function getId()
    {
        return $this->id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getEmails()
    {
        return $this->emails;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function setEmails($emails)
    {
        $this->emails = $emails;
        return $this;
    }
}

