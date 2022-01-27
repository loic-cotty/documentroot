<?php

namespace App\Controller;

use App\ApiClient\GoogleNewsClient;
use App\Repository\FavoriteRepository;
use FeedIo\FeedIo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @var FeedIo
     */
    private FeedIo $feedIo;

    /**
     * @param FeedIo $feedIo
     */
    public function __construct(FeedIo $feedIo)
    {
        $this->feedIo = $feedIo;
    }

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

        //$feedIo = $this->container->get('feedio');
        $feed = $this->feedIo->read('https://www.eurosport.fr/rss.xml')->getFeed();


        foreach ( $feed as $item ) {
            //dd($item);
            //dump($item->getTitle());
            $item->setDescription(preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
                return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
            }, $item->getDescription()));
        }




        $lastNews = $googleNewsClient->getLastNews();
        //$sources = $googleNewsClient->getSources();

        return $this->render('index.html.twig', [
            'favorites' => $favoriteRepository->findAll(),
            'last_news' => $lastNews->articles,
            'eurosport_news' => $feed
            //'sources' => $sources
        ]);
    }
}
