<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * BlogController
 */
class BlogController extends AbstractController
{
    /**
     * @param PostRepository $postRepository
     * @return Response
     * @Route("/blog", name="blog")
     */
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('blog/index.html.twig', [
            'posts' => $postRepository->findBy([
                'type' => 'post'
            ])
        ]);
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return Response
     *
     * @Route("/blog/{slug}", name="blog_show")
     */
    #[Route('/blog/{slug}', name: 'blog_show')]
    public function show(Request $request, Post $post): Response
    {
        return $this->render('blog/show.html.twig', [
            'post' => $post
        ]);
    }
}
