<?php
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\HttpFoundation\Response;

class CrudTest extends WebTestCase
{
    /**
     * @var Client
     */
    private $client;
    
    protected function setUp()
    {
        $this->client = static::createClient();
    }
    
    public function testGetAll()
    {
        $response = $this->request('GET', '/projects');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->headers->get('Content-type'));
        $this->assertTrue(is_array(json_decode($response->getContent())));
    }
    
    public function errorParamProvider()
    {
        return [
            [['title' => '', 'description' => '', 'published' => 'a']],
            [['title' => '', 'description' => '', 'published' => '0']],
            [['title' => '', 'description' => '', 'published' => '1']],
            [['title' => '', 'description' => '', 'published' => 'true']],
            [['title' => '', 'description' => '', 'published' => 'false']],
            [['title' => '', 'description' => 'a', 'published' => 'a']],
            [['title' => '', 'description' => 'a', 'published' => '0']],
            [['title' => '', 'description' => 'a', 'published' => '1']],
            [['title' => '', 'description' => 'a', 'published' => 'true']],
            [['title' => '', 'description' => 'a', 'published' => 'false']],
            [['title' => 'a', 'description' => '', 'published' => 'a']],
            [['title' => 'a', 'description' => '', 'published' => '0']],
            [['title' => 'a', 'description' => '', 'published' => '1']],
            [['title' => 'a', 'description' => '', 'published' => 'true']],
            [['title' => 'a', 'description' => '', 'published' => 'false']],
            [['title' => 'a', 'description' => 'a', 'published' => 'a']]
        ];
    }
    
    /**
     * @dataProvider errorParamProvider
     */
    public function testCreateError(array $params = [])
    {
        $response = $this->request('POST', '/project', $params);
        $this->assertGreaterThanOrEqual(400, $response->getStatusCode());
        $this->assertLessThan(500, $response->getStatusCode());
    }
    
    public function testCreate()
    {
        $projectTitle = uniqid('TEST_TITLE_', true);
        $projectDescription = uniqid('TEST_DESCRIPTION_', true);
        $response = $this->request('POST', '/project', ['title' => $projectTitle, 'description' => $projectDescription, 'published' => true]);
        $content = $response->getContent();
        $this->assertEquals('application/json', $response->headers->get('Content-type'));
        $this->assertEquals(201, $response->getStatusCode(), 'Status code is expected to be 201 CREATED. '.$content);
        
        $responseContent = json_decode($content);
        $this->assertInstanceOf(stdClass::class, $responseContent);
        return $responseContent;
    }
    
    public function testGetError()
    {
        $response = $this->request('GET', '/project/alpha');
        $this->assertEquals(404, $response->getStatusCode());
    }
    
    /**
     * @depends testCreate
     */
    public function testGet(stdClass $result)
    {
        $response = $this->request('GET', '/project/'.$this->resolveId($result));
        $this->assertEquals(200, $response->getStatusCode());
        
        $this->assertEquals('application/json', $response->headers->get('Content-type'));
        $this->assertEquals($result, json_decode($response->getContent()));
        
        return $result;
    }
    
    /**
     * @depends testGet
     * @dataProvider errorParamProvider
     */
    public function testUpdateError(array $params = [], stdClass $result)
    {
        $response = $this->request('PUT', '/project/'.$this->resolveId($result));
        $this->assertGreaterThanOrEqual(400, $response->getStatusCode());
        $this->assertLessThan(500, $response->getStatusCode());
    }
    
    /**
     * @depends testGet
     */
    public function testUpdate(stdClass $result)
    {
        $projectTitle = uniqid('TEST_TITLE_', true);
        $projectDescription = uniqid('TEST_DESCRIPTION_', true);
        $response = $this->request('PUT', '/project/'.$this->resolveId($result), ['title' => $projectTitle, 'description' => $projectDescription, 'published' => true]);
        
        $content = $response->getContent();
        $this->assertEquals('application/json', $response->headers->get('Content-type'));
        $this->assertEquals(200, $response->getStatusCode(), 'Status code is expected to be 200 OK. '.$content);
        
        return $result;
    }
    
    /**
     * @depends testUpdate
     */
    public function testGetAfterPut(stdClass $result)
    {
        $response = $this->request('GET', '/project/'.$this->resolveId($result));
        $this->assertEquals(200, $response->getStatusCode());
        
        $this->assertEquals('application/json', $response->headers->get('Content-type'));
        $this->assertNotEquals($result, json_decode($response->getContent()));
        
        return json_decode($response->getContent());
    }
    
    /**
     * @depends testGetAfterPut
     */
    public function testDelete(stdClass $result)
    {
        $response = $this->request('DELETE', '/project/'.$this->resolveId($result));
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEquals($result, json_decode($response->getContent()));
        
        return json_decode($response->getContent());
    }
    
    /**
     * @depends testDelete
     */
    public function testGetAllAfterDelete(stdClass $result)
    {
        $response = $this->request('GET', '/projects');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->headers->get('Content-type'));
        
        $results = json_decode($response->getContent());
        foreach ($results as $resultElement) {
            $this->assertNotEquals($this->resolveId($result), $this->resolveId($resultElement));
        }
        
        return $result;
    }
    
    /**
     * @depends testGetAllAfterDelete
     */
    public function testGetAfterDelete(stdClass $result)
    {
        $response = $this->request('GET', '/project/'.$this->resolveId($result));
        $this->assertEquals(200, $response->getStatusCode());
        
        $this->assertEquals('application/json', $response->headers->get('Content-type'));
        $this->assertEquals($result, json_decode($response->getContent()));
    }
    
    private function request(string $method, string $uri, array $parameters = array()) : Response
    {
        $this->client->request($method, $uri, $parameters);
        return $this->client->getResponse();
    }
    
    private function resolveId(stdClass $data)
    {
        foreach ($data as $prop => $val) {
            if (preg_match('/id/i', $prop)) {
                return $val;
            }
        }
    }
}

