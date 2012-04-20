<?php

namespace IMDb;

use Goutte\Client;

class Search extends MovieList
{
    protected $query;
    protected $url;
    protected $crawler;

    public function __construct($query)
    {
        $this->query = $query;
        $this->url = "http://akas.imdb.com/find?q=".urlencode($query).";s=tt";
    }

    public function getMovies()
    {
        return $this->exactMatch() ? $this->parseMovie() : $this->parseMovies();
    }

    public function exactMatch()    
    {
        return 1 === $this->getCrawler()->filterXpath('//table[@id="title-overview-widget-layout"]')->count();
    }

    protected function parseMovie()
    {
        preg_match('/\d+/', $this->getCrawler()->filterXpath("//head/link[@rel='canonical']")->attr('href'), $matches);
        $id = $matches[0];
        $title = trim($this->getCrawler()->filterXpath('//h1/text()[1]')->text());
        
        return array(new Movie($id, trim($title)));
    }

    protected function getCrawler()
    {
        if (null === $this->crawler) {
            $client = new Client();
            $this->crawler = $client->request('GET', $this->url);
        }

        return $this->crawler; 
    }
}
