<?php

namespace App\Controller;

use App\ApiClient\GoogleNewsClient;
use App\Repository\FavoriteRepository;
use jcobhams\NewsApi\NewsApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @param FavoriteRepository $favoriteRepository
     * @return Response
     *
     * @Route("/", name="index")
     * @throws \jcobhams\NewsApi\NewsApiException
     */
    public function index(FavoriteRepository $favoriteRepository): Response
    {
        $googleNewsClient = new GoogleNewsClient();

        $lastNews = $googleNewsClient->getLastNews();
        //$sources = $googleNewsClient->getSources();

        return $this->render('index.html.twig', [
            'favorites' => $favoriteRepository->findAll(),
            'last_news' => $lastNews->articles,
            //'sources' => $sources
        ]);
    }
}
