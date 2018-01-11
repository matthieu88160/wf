<?php
use PHPUnit\Framework\TestCase;

class ExceptionTest extends TestCase
{
    private const TESTED_CLASS = 'Exception\NotAllowedRoleException';
    
    public function testClassExist()
    {
        $this->assertTrue(
            class_exists(self::TESTED_CLASS),
            sprintf('The class %s is expected to exist', self::TESTED_CLASS)
        );
    }
    
    /**
     * @depends testClassExist
     */
    public function testClassRuntime()
    {
        $message = sprintf('The class %s is expected to extends the class %s', self::TESTED_CLASS, RuntimeException::class);
        $reflex = new ReflectionClass(self::TESTED_CLASS);
        
        $this->assertNotFalse($reflex->getParentClass(), $message);
        
        $this->assertEquals(
            RuntimeException::class,
            $reflex->getParentClass()->getName(),
            $message
        );
    }
    
    /**
     * @depends testClassRuntime
     */
    public function testConstruct()
    {
        $reflex = new ReflectionClass(self::TESTED_CLASS);
        
        $this->assertEquals(
            5,
            $reflex->getConstructor()->getNumberOfParameters(),
            sprintf('The %s::__construct method is expected to receive 5 parameters', self::TESTED_CLASS)
        );
    }
    
    /**
     * @depends testConstruct
     */
    public function testGetMessage()
    {
        $class = self::TESTED_CLASS;
        
        $allowedRoles = ['ROLE_A', 'ROLE_B'];
        $role = 'ROLE_C';
        
        $instance = new $class($allowedRoles, $role, 'ERROR');
        
        $this->assertContains(
            $role,
            $instance->getMessage(),
            sprintf('The message of exception %s is expected to explicitely reference the given role', self::TESTED_CLASS)
        );
        $this->assertRegExp(
            sprintf('/%s, ?%s/i', $allowedRoles[0], $allowedRoles[1]),
            $instance->getMessage(),
            sprintf('The message of exception %s is expected to explicitely reference the allowed roles', self::TESTED_CLASS)
        );
    }
}

