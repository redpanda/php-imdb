<?php

namespace IMDb;

use Buzz\Browser;
use Symfony\Component\DomCrawler\Crawler;

abstract class MovieList
{
    public function getMovies()
    {
        return $this->parseMovies();
    }

    protected function parseMovies()
    {
        $movies = $ids = array();

        $this->getCrawler()->filterXpath("//a[contains(@href, '/title/tt')]")->each(function ($node, $i) use(&$ids) {
            preg_match('/\d+/', $node->getAttribute('href'), $matches);

            $title = $node->nodeValue;
            $ids[$matches[0]] = $title;
        });

        $ids = array_unique($ids);
        foreach ($ids as $id => $title) {
            $movies[] = new Movie($id, $title);
        }

        return $movies;
    }

    protected function getCrawler()
    {
        if (null === $this->crawler) {
            $client = new Browser();

            $this->crawler = new Crawler($client->get($this->url)->getContent());
        }

        return $this->crawler; 
    }
}
