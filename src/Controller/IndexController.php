<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 *
 */
class IndexController extends AbstractController
{
    /**
     * @var Environment
     */
    private Environment $twig;

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @param Environment $twig
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
    }

    /**
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return new Response($this->twig->render('index.html.twig', []));
    }

    /**
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return new Response($this->twig->render('about.html.twig', []));
    }

    /**
     * @param PostRepository $postRepository
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    #[Route('/poke', name: 'poke')]
    public function poke(PostRepository $postRepository): Response
    {
        $response = new Response($this->twig->render('poke.html.twig', [
            'pokes' => $postRepository->findBy([
                'type' => 'poke'
            ])
        ]));
        //$response->setSharedMaxAge(3600);
        return $response;
    }
}
