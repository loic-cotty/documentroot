<?php

namespace App\ApiClient;

use FeedIo\Factory;
use FeedIo\FeedIo;

class EurosportRssNews
{
    const EUROSPORT_RSS = 'https://www.eurosport.fr/rss.xml';

    /**
     * @var FeedIo
     */
    private FeedIo $eurosportFeed;

    public function __construct()
    {
        $this->eurosportFeed = Factory::create()->getFeedIo();
    }

    public function getNews()
    {
        $feed = $this->eurosportFeed->read(self::EUROSPORT_RSS)->getFeed();
        foreach ( $feed as $item ) {
            $item->setDescription(preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
                return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
            }, $item->getDescription()));
        }
        return $feed;
    }

}