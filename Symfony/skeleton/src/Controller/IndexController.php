<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use App\Finder\FolderIndexer;
use Symfony\Component\HttpKernel\KernelInterface;

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
    
    public function storageListAction(FolderIndexer $indexer, KernelInterface $kernel)
    {
        $location = sprintf('%s/var/storage', $kernel->getProjectDir());
        $list = $indexer->getFolderIndex($location);
        
        return new Response($this->twig->render('list/storage.html.twig', ['list' => $list]));
    }
}
