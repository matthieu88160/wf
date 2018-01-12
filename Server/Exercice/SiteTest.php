<?php
use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Crawler;

class SiteTest extends TestCase
{
    private const CONTEXT = __DIR__ . '/src/';
    
    public function testHtml()
    {
        $filename = self::CONTEXT.'homepage.php';
        
        ob_start();
        include $filename;
        $content = ob_get_clean();
        
        $crawler = new Crawler($content);
        
        $this->assertContains('DOCTYPE', strtoupper($content), 'An html page is expected to have a DOCTYPE directive');
        $this->assertCount(1, $crawler->filter('html'), 'An html page is expected to have a html tag');
        $this->assertCount(1, $crawler->filter('head'), 'An html page is expected to have a head tag');
        $this->assertCount(1, $crawler->filter('body'), 'An html page is expected to have a body tag');
    }
    
    /**
     * @depends testHtml
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
}

