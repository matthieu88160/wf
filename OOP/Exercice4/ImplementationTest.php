<?php

use PHPUnit\Framework\TestCase;
use Model\User;

class ImplementationTest extends TestCase
{
    private const USER_INTERFACE = 'Symfony\Component\Security\Core\User\UserInterface';
    
    public function testGitignoreExist()
    {
        $this->assertTrue(is_file(__DIR__.'/src/.gitignore'), 'You should add a gitignore file');
    }
    
    /**
     * @depends testGitignoreExist
     */
    public function testGitignore()
    {
        $content = file_get_contents(__DIR__.'/src/.gitignore');
        
        $this->assertContains('vendor/', $content, 'The "vendor/" folder must be ignored');
        $this->assertNotContains('composer.lock', $content, 'The file "composer.lock" must not be ignored');
    }
    
    public function testInterfaceExist()
    {
        $this->assertTrue(interface_exists(self::USER_INTERFACE));
    }

    /**
     * @depends testInterfaceExist
     */
    public function testImplementation()
    {
        $reflex = new ReflectionClass(User::class);
        
        $this->assertContains(self::USER_INTERFACE, $reflex->getInterfaceNames());
    }
}
