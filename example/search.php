<?php

require_once __DIR__.'/../autoload.php';

function display_movies($movies)
{
    foreach ($movies as $movie) {
        echo $movie->getId().' - '.$movie->getTitle().PHP_EOL;
    }
}

$s = new IMDb\Search('I killed my lesbian wife');
display_movies($s->getMovies());

$s = new IMDb\Search('I Am Legend');
display_movies($s->getMovies());


