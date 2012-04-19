<?php

namespace IMDb;

use Goutte\Client;

class Movie
{
    protected $id;
    protected $url;
    protected $title;
    protected $crawler;

    public function __construct($imdbId, $title = null)
    {
        $this->id = $imdbId;
        $this->title = $title;
        $this->url = 'http://akas.imdb.com/title/tt'.$imdbId.'/combined';
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        if (null === $this->title) {
            try {
                $this->title = trim($this->getCrawler()->filterXpath('//h1/text()[1]')->text());
            } catch (\Exception $e) {
                return null;
            }
        }

        return $this->title;
    }

    public function getYear()
    {
        try {
            return intval($this->getCrawler()->filterXpath("//a[contains(@href, '/year')]")->text());
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getDirectors()
    {
        $directors = array();

        try {
            $this->getCrawler()->filterXpath("//div[@id='director-info']/div/a")->each(function ($node, $i) use (&$directors) {
                $directors[] = $node->nodeValue;
            });
        } catch (\Exception $e) {
        }

        return $directors;
    }

    public function getCastMembers()
    {
        $members = array();

        try {
            $this->getCrawler()->filter("table.cast td.nm a")->each(function ($node, $i) use (&$members) {
                $members[] = $node->nodeValue;
            });
        } catch (\Exception $e) {
        }

        return $members;
    }

    public function getRating()
    {
        try {
            return floatval(substr($this->getCrawler()->filter('.starbar-meta b')->text(), 0, -3));
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getLength()
    {
        try {
            preg_match('/\d+/', $this->getCrawler()->filterXpath("//h5[text()='Runtime:']/..")->text(), $matches);
            return intval($matches[0]);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getGenres()
    {
        $genres = array();

        try {
            $this->getCrawler()->filterXpath("//div[@class='info-content']/a[contains(@href, '/Sections/Genres')]")->each(function ($node, $i) use (&$genres) {
                $genres[] = $node->nodeValue;
            });
        } catch (\Exception $e) {
        }

        return $genres;
    }

    public function getLanguages()
    {
        $languages = array();

        try {
            $this->getCrawler()->filterXpath("//a[contains(@href, '/language')]")->each(function ($node, $i) use (&$languages) {
                $languages[] = $node->nodeValue;
            });
        } catch (\Exception $e) {
            
        }

        return $languages;
    }

    public function getCountries()
    {
        $countries = array();

        try {
            $this->getCrawler()->filterXpath("//div[@class='info-content']/a[contains(@href, '/country/')]")->each(function ($node, $i) use (&$countries) {
                $countries[] = $node->nodeValue;
            });
        } catch (\Exception $e) {
            
        }

        return $countries;
    }

    public function getVotes()
    {
        try {
            return preg_replace('/[^\d+]/', "", $this->getCrawler()->filter('#tn15rating > .tn15more')->text());
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getColor()
    {
        try {
            return $this->getCrawler()->filterXpath("//a[contains(@href, '/search/title?colors=color')]")->text();
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getTrailer()
    {
        try {
            return 'http://imdb.com'.$this->getCrawler()->filterXpath("//a[contains(@href, '/video/screenplay/')]")->attr('href');
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getPlot()
    {
        try {
            $plot = htmlentities($this->getCrawler()->filterXpath("//h5[text()='Plot:']/..")->text());
            $plot = preg_replace('/Plot:/i', '', $plot);
            $plot = preg_replace('/add\ssummary|full\ssummary/i', '', $plot);
            $plot = preg_replace('/add\ssynopsis|full\ssynopsis/i', '', $plot);
            $plot = preg_replace('/&Acirc;|&nbsp;|&raquo;/i', '', $plot);
            $plot = str_replace('|', '', $plot);
            $plot = preg_replace('/see|more/i', '', $plot);

            return trim(html_entity_decode($plot));
        } catch (\Exception $e) {
            return null;
        }
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
