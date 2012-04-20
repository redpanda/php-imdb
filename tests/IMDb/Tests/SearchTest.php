<?php

namespace IMDb\Tests;

use IMDb\Search;
use IMDb\Movie;

class SearchTest extends \PHPUnit_Framework_TestCase
{
    private $search;

    public function setUp()
    {
        $this->search = new Search('Star Trek');
    }

    public function testGetMovies()
    {
        $this->assertTrue(is_array($this->search->getMovies()));
        $this->assertGreaterThanOrEqual(10, count($this->search->getMovies()));
    }

    public function testExactMatch()
    {
        $this->assertTrue(is_bool($this->search->exactMatch()));
        $this->assertFalse($this->search->exactMatch());
    }

    public function testSearchWithExactMatch()
    {
        $search = new Search('I killed my lesbian wife');
        $movies = $search->getMovies();

        $this->assertTrue(is_array($movies));
        $this->assertCount(1, $movies);
        $this->assertStringStartsWith('I Killed My Lesbian Wife, Hung Her on', $movies[0]->getTitle());
    }

    public function tearDown()
    {
        $this->search = null;
    }
}
