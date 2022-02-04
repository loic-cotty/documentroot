<?php

namespace App\Controller;

use App\ApiClient\EurosportRssNews;
use App\ApiClient\GoogleNewsClient;
use App\Repository\FavoriteRepository;
use FeedIo\FeedIo;
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
     */
    public function index(FavoriteRepository $favoriteRepository): Response
    {
        $eurosportFeed = new EurosportRssNews();
        $feed = $eurosportFeed->getNews();

        $googleNewsClient = new GoogleNewsClient();
        $lastNews = $googleNewsClient->getLastNews();

        return $this->render('index.html.twig', [
            'favorites' => $favoriteRepository->findAll(),
            'last_news' => $lastNews,
            'eurosport_news' => $feed
            //'sources' => $sources
        ]);
    }
}
