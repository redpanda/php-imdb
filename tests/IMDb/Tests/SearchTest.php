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
        $this->assertTrue(count($this->search->getMovies()) > 10);
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
        $this->assertSame(1, count($movies));
        $this->assertSame('I Killed My Lesbian Wife, Hung Her on a Meat Hook, and Now I Have a Three-Picture Deal at Disney', $movies[0]->getTitle());
    }

    public function tearDown()
    {
        $this->search = null;
    }
}
