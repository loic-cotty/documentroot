<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/', name: 'document_root')]
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'controller_name' => 'BlogController',
            'method' => 'index'
        ]);
    }

    #[Route('/blog', name: 'blog')]
    public function blogIndex(): Response
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'method' => 'blogIndex'
        ]);
    }
}
