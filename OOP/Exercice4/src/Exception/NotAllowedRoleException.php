<?php
namespace Exception;

class NotAllowedRoleException extends \RuntimeException
{
    private $allowedRoles;
    private $givenRole;
    
    public function __construct ($allowedRoles = [], $givenRole = '', $message = null, $code = null, $previous = null) {
        $this->allowedRoles = $allowedRoles;
        $this->givenRole = $givenRole;
        
        parent::__construct($message, $code, $previous);
        $this->updateMessage();
    }
    
    protected function updateMessage()
    {
        $this->message = sprintf(
            'The role "%s" is not allowed. Only "%s" are allowed. %s',
            $this->givenRole,
            implode(', ', $this->allowedRoles),
            (string)parent::getMessage()
        );
    }
}

