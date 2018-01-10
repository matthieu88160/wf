<?php
use PHPUnit\Framework\TestCase;

spl_autoload_register(
    function($className){
        $filename = sprintf('%s/src/%s.php', __DIR__, str_replace('\\', '/', $className));
        
        if (is_file($filename)) {
            require_once $filename;
        }
    }
);

class ExerciseTest extends TestCase
{
    private const PERSON_CLASS = 'Model\Person';
    private const USER_CLASS = 'Model\User';
    
    static private $classTested = [];
    
    public function classProvider()
    {
        return [
            [self::PERSON_CLASS],
            [self::USER_CLASS]
        ];
    }
    
    /**
     * @dataProvider classProvider
     */
    public function testClassExist(string $class) : void
    {
        if (in_array($class, self::$classTested) && !class_exists($class)) {
            $this->markTestSkipped();
            return;
        }
        
        self::$classTested[] = $class;
        $this->assertTrue(class_exists($class), 'The class '.$class.' is expected to exist');
        
        return;
    }
    
    /**
     * @dataProvider classProvider
     */
    public function testClassProperties(string $class) : void
    {
        $this->testClassExist($class);
        
        $this->validatePropertyMap($this->gessClassPropertyMap($class), $class);
        
        return;
    }
    
    public function testPersonEmail() : void
    {
        $class = self::PERSON_CLASS;
        $this->testClassExist($class);
        $reflex = new ReflectionClass($class);
        
        $this->assertTrue($reflex->hasProperty('emails'), 'The class Person is expected to have a property email');
        $email = $reflex->getProperty('emails');
        $email->setAccessible(true);
        
        $person = new $class();
        
        $this->assertTrue(is_array($email->getValue($person)), 'The property emails of class Person is expected to be initialized as array');
        $this->assertEmpty($email->getValue($person), 'The property emails of class Person is expected to be initialized as empty array');
        
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
        $personClass = self::PERSON_CLASS;
        $userClass = self::USER_CLASS;
        
        return [
            ['getId', $personClass, 123, 'id'],
            ['getFirstname', $personClass, 'Gill', 'firstname'],
            ['getLastname', $personClass, 'Bates', 'lastname'],
            ['getEmails', $personClass, ['gill.bates@sicromoft.com'], 'emails'],
            ['getId', $userClass, 123, 'id'],
            ['getRoles', $userClass, 123, 'roles'],
            ['getPassword', $userClass, 123, 'password'],
            ['getSalt', $userClass, 123, 'salt'],
            ['getUsername', $userClass, 123, 'username']
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
        $personClass = self::PERSON_CLASS;
        $userClass = self::USER_CLASS;
        
        return [
            ['setFirstname', $personClass, 'Gill', 'firstname'],
            ['setLastname', $personClass, 'Bates', 'lastname'],
            ['setEmails', $personClass, ['gill.bates@sicromoft.com'], 'emails'],
            ['setRoles', $userClass, 123, 'roles'],
            ['setPassword', $userClass, 123, 'password'],
            ['setSalt', $userClass, 123, 'salt'],
            ['setUsername', $userClass, 123, 'username']
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

