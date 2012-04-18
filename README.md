ffffilm
=======

### Install vendors

    wget http://getcomposer.org/composer.phar
    php composer.phar install

### Update vendors

    php composer.phar update

Basic usage
-----------

### Get Movie

    <?php
    $i = new IMDb\Movie(0095016);
    $i->getTitle();

### Search movie

    <?php
    $s = new IMDb\Search(Star Trek);
    $s->getMovies();

Command line
-------------

### Get movie

    bin/imdb show 0095016

### Search movie

    bin/imdb search "Star Trek"

### Run the tests (requires PHPUnit >= 3.5)

    phpunit
