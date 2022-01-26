<?php

namespace App\Controller;

use App\Repository\FavoriteRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class IndexController
 */
class IndexController extends AbstractController
{
    /**
     * @return Response
     *
     * @Route("/", name="index")
     */
    #[Route('/', name: 'index')]
    public function index(FavoriteRepository $favoriteRepository): Response
    {
        return $this->render('index.html.twig', [
            'favorites' => $favoriteRepository->findAll()
        ]);
    }

    /**
     * @return Response
     *
     * @Route("/about", name="about")
     */
    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }

    /**
     * @param PostRepository $postRepository
     * @return Response
     *
     * @Route("/poke", name="poke")
     */
    #[Route('/poke', name: 'poke')]
    public function poke(PostRepository $postRepository): Response
    {
        return $this->render('poke.html.twig', [
            'pokes' => $postRepository->findBy([
                'type' => 'poke'
            ])
        ]);
    }
}
