<?php
use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Crawler;

class SiteTest extends TestCase
{
    private const CONTEXT = __DIR__ . '/src/';
    
    public function testSession()
    {
        $filename = self::CONTEXT.'addpage.php';
        $this->assertFileExists($filename, 'The file addpage.php is expected to be defined');
        
        $_SERVER['REQUEST_METHOD'] = 'GET';
            
        ob_start();
        include $filename;
        ob_end_clean();
        
        $this->assertEquals(PHP_SESSION_NONE, session_status(), 'The session is expected to be closed before the end of script');
        
        session_start();
        
        $this->assertNotEmpty($_SESSION, 'The session is not expected to be empty');
    }
    
    public function testHomePageHtml()
    {
        $filename = self::CONTEXT.'homepage.php';
        $this->assertFileExists($filename, 'The file homepage.php is expected to be defined');
        
        ob_start();
        include $filename;
        $this->isHtmlValid(ob_get_clean());
    }
    
    /**
     * @depends testHomePageHtml
     */
    public function testHomePage()
    {
        $filename = self::CONTEXT.'homepage.php';
        $this->assertFileExists($filename, 'The file homepage.php is expected to be defined');
        
        ob_start();
        include $filename;
        $content = ob_get_clean();
        
        $crawler = new Crawler($content);
        
        $this->assertCount(5, $crawler->filter('img'), 'The images for the 5 projects are expected to be displayed');
        
        $fixtures = include __DIR__.'/fixture.php';
        
        foreach ($fixtures as $project) {
            list($image, $title, $description) = $project;

            $this->assertCount(1, $crawler->filter('img[src="'.$image.'"]'), 'Each project is expected to display it\'s own image');
            $this->assertCount(1, $crawler->filter('html:contains("'.$title.'")'), 'Each project is expected to display it\'s own title');
            $this->assertCount(1, $crawler->filter('html:contains("'.$description.'")'), 'Each project is expected to display it\'s own description');
        }
    }
    
    public function testAddPageHtml()
    {
        $filename = self::CONTEXT.'addpage.php';
        $this->assertFileExists($filename, 'The file addpage.php is expected to be defined');
        
        ob_start();
        include $filename;
        $this->isHtmlValid(ob_get_clean());
    }
    
    /**
     * @depends testAddPageHtml
     */
    public function testAddPage()
    {
        $filename = self::CONTEXT.'addpage.php';
        $this->assertFileExists($filename, 'The file addpage.php is expected to be defined');
        
        ob_start();
        $_SERVER['REQUEST_METHOD'] = 'GET';
        include $filename;
        $content = ob_get_clean();
        
        $crawler = new Crawler($content);
        
        $this->assertCount(1, $crawler->filter('form'), 'A form must be included into a "form" tag');
        
        $this->assertCount(1, $crawler->filter('input[name="addProject_title"]'), 'The addProject_title field must be included');
        $this->assertEquals('text', $crawler->filter('input[name="addProject_title"]')->attr('type'), 'The addProject_title field is expected to be of type text');
        
        $this->assertCount(1, $crawler->filter('textarea[name="addProject_description"]'), 'The addProject_description field must be included');
        
        $this->assertCount(1, $crawler->filter('input[name="addProject_image"]'), 'The addProject_image field must be included');
        $this->assertEquals('file', $crawler->filter('input[name="addProject_image"]')->attr('type'), 'The addProject_image field is expected to be of type file');
        
        $this->assertCount(1, $crawler->filter('input[name="addProject_csrf_token"]'), 'The addProject_csrf_token field must be included');
        $this->assertEquals('hidden', $crawler->filter('input[name="addProject_csrf_token"]')->attr('type'), 'The addProject_csrf_token field is expected to be of type hidden');
        
        $this->assertGreaterThanOrEqual(1, $crawler->filter('button')->count(), 'A form is expected to have a button');
        $this->assertEquals(1, $crawler->filter('button[type="submit"]')->count(), 'A form is expected to have a submit button');
    }
    
    protected function isHtmlValid($content)
    {
        $crawler = new Crawler($content);
        
        $this->assertContains('DOCTYPE', strtoupper($content), 'An html page is expected to have a DOCTYPE directive');
        $this->assertCount(1, $crawler->filter('html'), 'An html page is expected to have a html tag');
        $this->assertCount(1, $crawler->filter('head'), 'An html page is expected to have a head tag');
        $this->assertCount(1, $crawler->filter('body'), 'An html page is expected to have a body tag');
    }
}

