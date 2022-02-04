<?php

namespace App\ApiClient;

use Exception;
use jcobhams\NewsApi\NewsApi;
use jcobhams\NewsApi\NewsApiException;

class GoogleNewsClient
{
    const CATEGORIES = [
        'general',
        'sports',
        'business',
        'entertainment',
        'health',
        'science',
        'sports',
        'technology'
    ];

    /**
     * @var string|null
     */
    private ?string $country;

    /**
     * @var string|null
     */
    private ?string $language;

    /**
     * @var string|null
     */
    private ?string $q;

    /**
     * @var string|null
     */
    private ?string $sources;

    /**
     * @var string|null
     */
    private ?string $category;

    /**
     * @var int|null
     */
    private ?int $page_size;

    /**
     * @var int|null
     */
    private ?int $page;

    /**
     *
     */
    public function __construct()
    {
        $this->country = 'fr';
        $this->language = null;
        $this->q = null;
        $this->sources = null;
        $this->category = null;
        $this->page_size = null;
        $this->page = null;
    }

    /**
     * @return mixed|void
     */
    public function getLastNews()
    {
        try {
            $client = new NewsApi('5ca9e16a83da4571b3edb1ff48a23f7b');
            return $client->getTopHeadlines($this->q, $this->sources, $this->country, $this->category, $this->page_size, $this->page)->articles;
        } catch (NewsApiException|Exception $e) {
            var_dump($e->getCode());
            var_dump($e->getMessage());
            return null;
        }

    }

    /**
     * @return mixed|void
     */
    public function getSources()
    {
        try {
            $client = new NewsApi('5ca9e16a83da4571b3edb1ff48a23f7b');
            return $client->getSources($this->category, $this->language, $this->country);
        } catch (NewsApiException|Exception $e) {
            var_dump($e->getCode());
            var_dump($e->getMessage());
            return null;
        }
    }

}
