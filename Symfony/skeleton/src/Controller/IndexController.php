<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class IndexController
{
    public function indexAction()
    {
        return new Response('<!DOCTYPE html><html><head></head><body>hello world</body></html>');
    }
}

