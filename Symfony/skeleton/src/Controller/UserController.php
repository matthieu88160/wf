<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use App\Entity\User;
use App\Form\UserFormType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Role;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController
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
    
    public function registerAction(Request $request, EncoderFactoryInterface $encoderFactory, TokenStorageInterface $tokenStorage)
    {
        $user = new User();
        
        $form = $this->formFactory->create(UserFormType::class, $user, ['standalone' => true]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $role = $this->manager->getRepository(Role::class)->findOneByLabel(Role::ROLE_USER);
            if (!$role) {
                throw new \RuntimeException('User cannot be created with role configuration');
            }
            $user->addRole($role);
            $user->setSalt(md5($user->getUsername()));
            
            $password = $encoderFactory->getEncoder(User::class)->encodePassword($user->getPassword(), $user->getSalt());
            $user->setPassword($password);
            
            $this->manager->persist($user);
            $this->manager->flush();
            
            $tokenStorage->setToken(new UsernamePasswordToken($user, null, 'main', $user->getRoles()));
            
            return new RedirectResponse($this->urlGenerator->generate('index'));
        }
        
        return new Response($this->twig->render('registration.html.twig', ['form' => $form->createView()]));
    }
    
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();
        
        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();
        
        return new Response(
            $this->twig->render(
                'login/login.html.twig', array(
                    'last_username' => $lastUsername,
                    'error'         => $error,
                )
            )
        );
    }
}

