<?php

namespace IMDb;

use Goutte\Client;

abstract class MovieList
{
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
}
