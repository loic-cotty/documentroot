<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class BlogController extends AbstractController
{
    private Environment $twig;
    private EntityManagerInterface $entityManager;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
    }

    #[Route('/blog', name: 'blog')]
    public function index(PostRepository $postRepository): Response
    {
        $response = new Response($this->twig->render('blog/index.html.twig', [
            'posts' => $postRepository->findAll()
        ]));
        //$response->setSharedMaxAge(3600);
        return $response;
    }

    #[Route('/blog/{slug}', name: 'blog_show')]
    public function show(Request $request, Post $post)
    {
        return new Response($this->twig->render('blog/show.html.twig', [
            'post' => $post
        ]));
    }
}
