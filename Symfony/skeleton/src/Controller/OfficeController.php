<?php
namespace App\Controller;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Project;
use App\Form\ProjectFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class OfficeController
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;
    
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    
    /**
     * @var Environment
     */
    private $twig;
    
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;
    
    public function __construct(FormFactoryInterface $formFactory, EntityManagerInterface $manager, Environment $twig, UrlGeneratorInterface $urlGenerator)
    {
        $this->formFactory = $formFactory;
        $this->manager = $manager;
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }
    
    public function projectListAction()
    {   
        return new Response(
            $this->twig->render(
                'office/project_list.html.twig',
                [
                    'projects' => $this->manager
                        ->getRepository(Project::class)
                        ->findBy(['deleted' => false])
                ]
            )
        );
    }
    
    public function projectFormAction(Request $request, Project $project = null)
    {
        if ($project === null) {
            $project = new Project();
        }
        
        $form = $this->formFactory->create(ProjectFormType::class, $project, ['standalone' => true]);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($project);
            $this->manager->flush();
            
            return new RedirectResponse($this->urlGenerator->generate('project_office_list'));
        }
        
        return new Response($this->twig->render('office/project.html.twig', ['form' => $form->createView()]));
    }
}

