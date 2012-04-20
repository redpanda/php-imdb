<?php

namespace IMDb\Tests;

use IMDb\Search;

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

    public function tearDown()
    {
        $this->search = null;
    }
}
