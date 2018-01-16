<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;

class IndexTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        
        $client->request('GET', '/');
        $response = $client->getResponse();
        
        $this->assertNotNull($response);
        $this->assertEquals(200, $response->getStatusCode());
        
        $crawler = new Crawler($response->getContent());
        
        $this->assertContains('hello world', strtolower($crawler->filterXPath('//body')->html()));
    }
}
