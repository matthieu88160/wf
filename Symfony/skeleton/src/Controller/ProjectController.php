<?php
namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Project;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Exception\InvalidArgumentException;

class ProjectController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    
    /**
     * @var SerializerInterface
     */
    private $serializer;
    
    public function __construct(EntityManagerInterface $manager, SerializerInterface $serializer)
    {
        $this->entityManager = $manager;
        $this->serializer = $serializer;
    }
    
    public function getProjectsAction()
    {
        $data = $this->entityManager
            ->getRepository(Project::class)
            ->findBy(['deleted' => false, 'published' => true]);
            
        return $this->dataToJsonResponse($data);
    }
    
    public function getProjectAction(Project $project)
    {
        return $this->dataToJsonResponse($project);
    }
    
    public function addProjectAction(Request $request)
    {
        try {
            $data = $this->validateProjectData($request);
        } catch (InvalidArgumentException $exception) {
            return new JsonResponse(['state' => 'error', 'message' => $exception->getMessage()], 400);
        }
        
        $project = new Project();
        $this->hydrateProject($project, $data);
        $this->entityManager->persist($project);
        $this->entityManager->flush();
        
        return $this->dataToJsonResponse($project, 201);
    }
    
    public function updateProjectAction(Request $request, Project $project)
    {
        try {
            $data = $this->validateProjectData($request);
        } catch (InvalidArgumentException $exception) {
            return new JsonResponse(['state' => 'error', 'message' => $exception->getMessage()], 400);
        }
        
        $this->hydrateProject($project, $data);
        $this->entityManager->flush();
        
        return $this->dataToJsonResponse($project);
    }
    
    public function deleteProjectAction(Project $project)
    {
        $project->setDeleted(true);
        
        $this->entityManager->flush();
        
        return new JsonResponse($this->serializer->serialize($project, 'json'), 200, [], true);
    }
    
    private function dataToJsonResponse($data, $status = 200)
    {
        return new JsonResponse($this->serializer->serialize($data, 'json'), $status, [], true);
    }
    
    private function hydrateProject(Project $project, array $data)
    {
        $project->setName($data['title'])
            ->setDescription($data['description'])
            ->setPublished($data['published']);
    }
    
    private function validateProjectData(Request $request)
    {
        $data = $this->getOptionResolver()->resolve($request->request->all());
        
        foreach ($data as $key => $value) {
            if(empty($value) && in_array($key, ['title', 'description'])) {
                throw new InvalidArgumentException(sprintf('The option "%s" cannot be empty', $key));
            }
        }
        
        $data['published'] = $request->request->getBoolean('published');
        
        return $data;
    }
    
    private function getOptionResolver()
    {
        $resolver = new OptionsResolver();
        
        $resolver->setRequired('title')
            ->setRequired('description')
            ->setRequired('published');
        
        $resolver->setAllowedTypes('title', 'string');
        $resolver->setAllowedTypes('description', 'string');
        $resolver->setAllowedTypes('published', ['string', 'bool']);
        
        $resolver->setAllowedValues('published', ['0', '1', 'true', 'false', true, false]);
        
        return $resolver;
    }
}
