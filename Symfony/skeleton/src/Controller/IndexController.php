<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class IndexController
{
    private $twig;
    
    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }

    public function indexAction()
    {
        return new Response($this->twig->render('index/index.html.twig'));
    }
}
