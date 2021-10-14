<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[Route('/admin', name: 'admin_')]
class PostController extends AbstractController
{
    /**
     * @var Environment
     */
    private Environment $twig;

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * @param Environment $twig
     */
    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->em = $entityManager;
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    #[Route('/post/edit/{slug}', name: 'post_edit')]
    public function edit(Request $request, Post $post): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            $this->addFlash('success', 'post.updated_successfully');

            return $this->redirectToRoute('admin_post_edit', ['slug' => $post->getSlug()]);
        }

        return new Response($this->twig->render('Admin/Post/edit.html.twig', [
            'form' => $form->createView(),
            'post' => $post
        ]));
    }
}