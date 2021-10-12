<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class IndexController extends AbstractController
{
    private Environment $twig;
    private EntityManagerInterface $entityManager;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return new Response($this->twig->render('index.html.twig', []));
    }

    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return new Response($this->twig->render('about.html.twig', []));
    }

    #[Route('/poke', name: 'poke')]
    public function poke(): Response
    {
        return new Response($this->twig->render('poke.html.twig', []));
    }
}
