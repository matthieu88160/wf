<?php
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private const USER_CLASS = 'Model\User';
    
    public function testClassExist() : void
    {
        $this->assertTrue(class_exists(self::USER_CLASS), 'The class '.self::USER_CLASS.' is expected to exist');
        
        return;
    }
    
    /**
     * @depends testClassExist
     */
    public function testClassProperties() : void
    {
        $this->validatePropertyMap($this->getUserPropertyMap(), self::USER_CLASS);
        
        return;
    }
    
    public function testUserRole() : void
    {
        $class = self::USER_CLASS;
        $this->testClassExist($class);
        $reflex = new ReflectionClass($class);
        
        $this->assertTrue($reflex->hasProperty('roles'), 'The class User is expected to have a property roles');
        $roles = $reflex->getProperty('roles');
        $roles->setAccessible(true);
        
        $user = new $class();
        
        $this->assertTrue(is_array($roles->getValue($user)), 'The property roles of class User is expected to be initialized as array');
        $this->assertEmpty($roles->getValue($user), 'The property roles of class User is expected to be initialized as empty array');
        
        return;
    }
    
    public function getterProvider() : array
    {
        return [
            ['getId', self::USER_CLASS, 123, 'id'],
            ['getPassword', self::USER_CLASS, 123, 'password'],
            ['getSalt', self::USER_CLASS, 123, 'salt'],
            ['getUsername', self::USER_CLASS, 123, 'username']
        ];
    }
    
    /**
     * @dataProvider getterProvider
     */
    public function testGetter($getter, $class, $value, $property) : void
    {
        $this->testClassExist($class);
        $this->testClassProperties($class);
        
        $reflex = new ReflectionClass($class);
        $propReflex = $reflex->getProperty($property);
        $propReflex->setAccessible(true);
        
        $instance = new $class();
        $propReflex->setValue($instance, $value);
        
        $this->assertTrue($reflex->hasMethod($getter), 'The class '.$class.' is expected to have a method called "'.$getter.'"');
        $this->assertTrue($reflex->getMethod($getter)->isPublic(), 'The method '.$getter.' of class '.$class.' is expected to be public');
        $this->assertEquals($value, $instance->{$getter}(), 'The method '.$getter.' of class '.$class.' is expected to return the "'.$property.'" value');
        
        return;
    }
    
    public function setterProvider() : array
    {
        if (class_exists('Model\Role')) {
            $role = $this->createMock('Model\Role');
        } else {
            $role = null;
        }

        return [
            ['setRoles', self::USER_CLASS, [$role], 'roles'],
            ['setPassword', self::USER_CLASS, 123, 'password'],
            ['setSalt', self::USER_CLASS, 123, 'salt'],
            ['setUsername', self::USER_CLASS, 123, 'username']
        ];
    }
    
    /**
     * @dataProvider setterProvider
     */
    public function testSetter($setter, $class, $value, $property) : void
    {
        $this->testClassExist($class);
        $this->testClassProperties($class);
        
        $reflex = new ReflectionClass($class);
        $propReflex = $reflex->getProperty($property);
        $propReflex->setAccessible(true);
        
        $instance = new $class();
        $result = $instance->{$setter}($value);
        
        $this->assertTrue($reflex->hasMethod($setter), 'The class '.$class.' is expected to have a method called "'.$setter.'"');
        $this->assertTrue($reflex->getMethod($setter)->isPublic(), 'The method '.$setter.' of class '.$class.' is expected to be public');
        $this->assertEquals($value, $propReflex->getValue($instance), 'The method '.$setter.' of class '.$class.' is expected to set the "'.$property.'" value');
        $this->assertSame($instance, $result, 'The method '.$setter.' of class '.$class.' is expected to be fluent');
        
        return;
    }
    
    /**
     * @depends testSetter
     */
    public function testGetRoles()
    {
        if (!class_exists('Model\Role')) {
            $this->fail('The class Model\Role is expected to exist');
        }
        
        $role = $this->createMock('Model\Role');
        $role->expects($this->any())
            ->method('getLabel')
            ->willReturn('ROLE_HELLO_WORLD');
        
        $class = 'Model\User';
        $instance = new $class();
        
        $this->assertEquals(['ROLE_USER'], $instance->getRoles());
        
        $instance->addRole($role);
        $this->assertContains('ROLE_USER', $instance->getRoles());
        $this->assertContains('ROLE_HELLO_WORLD', $instance->getRoles());
    }
    
    public function testEraseCredentials() : void
    {
        $class = self::USER_CLASS;
        $this->testClassExist($class);
        $this->testClassProperties($class);
        
        $reflex = new ReflectionClass($class);
        
        $password = $reflex->getProperty('password');
        $password->setAccessible(true);
        
        $salt = $reflex->getProperty('salt');
        $salt->setAccessible(true);
        
        $this->assertTrue($reflex->hasMethod('eraseCredentials'), 'The class '.$class.' is expected to have a method called "eraseCredentials"');
        $this->assertTrue($reflex->getMethod('eraseCredentials')->isPublic(), 'The method "eraseCredentials" of class '.$class.' is expected to be public');
        
        $instance = new $class();
        $password->setValue($instance, 'hello');
        $salt->setValue($instance, 'world');
        $instance->eraseCredentials();
        
        $this->assertNull($password->getValue($instance), 'The method "eraseCredentials" of class '.$class.' is expected to erase the stored password');
        $this->assertNull($salt->getValue($instance), 'The method "eraseCredentials" of class '.$class.' is expected to erase the stored salt');
        
        return;
    }
    
    private function validatePropertyMap(array $propertyMap, string $class) : void
    {
        $reflex = new ReflectionClass($class);
        
        foreach ($propertyMap as $property => $visibility) {
            $this->assertTrue(
                $reflex->hasProperty($property),
                'The class '.$class.' is expected to have a public property '.$property
                );
            $this->assertTrue(
                $reflex->getProperty($property)->{'is'.ucfirst($visibility)}(),
                'The property '.$property.' of class '.$class.' is expected to be '.$visibility
                );
        }
        
        return;
    }
    
    private function gessClassPropertyMap($class) : array
    {
        if($class == self::PERSON_CLASS) {
            return $this->getPersonPropertyMap();
        }
        
        return $this->getUserPropertyMap();
    }
    
    private function getUserPropertyMap() : array
    {
        return [
            'id' => 'private',
            'roles' => 'protected',
            'password' => 'protected',
            'salt' => 'protected',
            'username' => 'protected'
        ];
    }
    
    private function getPersonPropertyMap() : array
    {
        return [
            'id' => 'private',
            'firstname' => 'protected',
            'lastname' => 'protected',
            'emails' => 'protected'
        ];
    }
}

