PHP IMDb
========

A PHP 5.3 library for scraping IMDb, strongly inspired by [imdb](https://github.com/ariejan/imdb).

## Installation

### Install vendors

    wget http://getcomposer.org/composer.phar
    php composer.phar install

### Update vendors

    php composer.phar update

## Usage

### Get Movie

```php
<?php
$i = new IMDb\Movie("0095016");
$i->getTitle();
```

### Search movie

```php
<?php
$s = new IMDb\Search("Star Trek");
foreach ($s->getMovies() as $movie) {
    echo $movie->getTitle().PHP_EOL;
}
```

## Command line

### Get movie

    bin/imdb show 0095016

### Search movie

    bin/imdb search "Star Trek"

## Tests

### Run the tests (requires PHPUnit >= 3.5)

    phpunit

## License

MIT, see LICENSE
