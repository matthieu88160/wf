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

class RoleTest extends TestCase
{
    protected const ROLE_CLASS = 'Model\Role';
    
    public function testClassExist() : void
    {
        $class = self::ROLE_CLASS;
        
        $this->assertTrue(class_exists($class), 'The class '.$class.' is expected to exist');
        
        return;
    }
    
    public function constantProvider() : array
    {
        return [
            ['ROLE_USER'],
            ['ROLE_ADMIN']
        ];
    }
    
    /**
     * @dataProvider constantProvider
     * @depends      testClassExist
     */
    public function testConstants(string $constant)
    {
        $reflex = new ReflectionClass(self::ROLE_CLASS);
        $this->assertTrue($reflex->hasConstant($constant), sprintf('The class %s is expected to own the constant %s', self::ROLE_CLASS, $constant));
        $this->assertEquals($constant, $reflex->getConstant($constant), sprintf('The constant %s of class %s is expected to contain "%s" as value', $constant, self::ROLE_CLASS, $constant));
    }
    
    /**
     * @depends      testClassExist
     */
    public function testPropertyMap()
    {
        $this->validatePropertyMap($this->propertyProvider(), self::ROLE_CLASS);
    }
    
    /**
     * @depends     testClassExist
     * @depends     testPropertyMap
     */
    public function testConstructor()
    {
        $reflex = new ReflectionClass(self::ROLE_CLASS);
        
        $this->assertEquals(
            1,
            $reflex->getConstructor()->getNumberOfRequiredParameters(),
            sprintf('The class %s is expected to need the label parameter as constructor argument', self::ROLE_CLASS)
        );
        
        $class = self::ROLE_CLASS;
        $instance = new $class('LABEL');
        
        $label = $reflex->getProperty('label');
        $label->setAccessible(true);
        $this->assertEquals(
            'LABEL',
            $label->getValue($instance),
            sprintf('The %s constructor is expected to setup the label property', self::ROLE_CLASS)
        );
    }
    
    public function getterProvider() : array
    {   
        return [
            ['getId', self::ROLE_CLASS, 123, 'id'],
            ['getLabel', self::ROLE_CLASS, 'ROLE_AUTHENTICATED', 'label']
        ];
    }
    
    /**
     * @dataProvider getterProvider
     * @depends      testClassExist
     * @depends      testPropertyMap
     */
    public function testGetter($getter, $class, $value, $property) : void
    {   
        $reflex = new ReflectionClass($class);
        $propReflex = $reflex->getProperty($property);
        $propReflex->setAccessible(true);
        
        $instance = new $class('LABEL');
        $propReflex->setValue($instance, $value);
        
        $this->assertTrue($reflex->hasMethod($getter), 'The class '.$class.' is expected to have a method called "'.$getter.'"');
        $this->assertTrue($reflex->getMethod($getter)->isPublic(), 'The method '.$getter.' of class '.$class.' is expected to be public');
        $this->assertEquals($value, $instance->{$getter}(), 'The method '.$getter.' of class '.$class.' is expected to return the "'.$property.'" value');
        
        return;
    }
    
    public function setterProvider() : array
    {
        return [
            ['setLabel', self::ROLE_CLASS, 'ROLE_AUTHENTICATED', 'label']
        ];
    }
    
    /**
     * @dataProvider setterProvider
     * @depends      testClassExist
     * @depends      testPropertyMap
     */
    public function testSetter($setter, $class, $value, $property) : void
    {
        $reflex = new ReflectionClass($class);
        $propReflex = $reflex->getProperty($property);
        $propReflex->setAccessible(true);
        
        $instance = new $class('LABEL');
        $result = $instance->{$setter}($value);
        
        $this->assertTrue($reflex->hasMethod($setter), 'The class '.$class.' is expected to have a method called "'.$setter.'"');
        $this->assertTrue($reflex->getMethod($setter)->isPublic(), 'The method '.$setter.' of class '.$class.' is expected to be public');
        $this->assertEquals($value, $propReflex->getValue($instance), 'The method '.$setter.' of class '.$class.' is expected to set the "'.$property.'" value');
        $this->assertSame($instance, $result, 'The method '.$setter.' of class '.$class.' is expected to be fluent');
        
        return;
    }
    
    private function propertyProvider()
    {
        return [
            'id' => 'private',
            'label' => 'protected'
        ];
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
}

