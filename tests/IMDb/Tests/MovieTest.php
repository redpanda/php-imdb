<?php

namespace IMDb\Tests;

use IMDb\Movie;

class MovieTest extends \PHPUnit_Framework_TestCase
{
    private $movie;

    public function setUp()
    {
        $this->movie = new Movie('0095016');
    }

    public function testGetTitle()
    {
        $this->assertTrue(is_string($this->movie->getTitle()));
        $this->assertSame('Die Hard', $this->movie->getTitle());
    }

    public function testGetYear()
    {
        $this->assertTrue(is_int($this->movie->getYear()));
        $this->assertSame(1988, $this->movie->getYear());
    }

    public function testGetDirectors()
    {
        $this->assertTrue(is_array($this->movie->getDirectors()));
        $this->assertSame(1, count($this->movie->getDirectors()));
        $this->assertSame(array('0001532' => 'John McTiernan'), $this->movie->getDirectors());
    }

    public function testGetCastMembers()
    {
        $this->assertTrue(is_array($this->movie->getCastMembers()));
    }

    public function testGetCastCharacters()
    {
        $this->assertTrue(is_array($this->movie->getCastCharacters()));
    }

    public function testGetGenres()
    {
        $this->assertTrue(is_array($this->movie->getGenres()));
        $this->assertSame(2, count($this->movie->getGenres()));
        $this->assertSame(array('Action', 'Thriller'), $this->movie->getGenres());
    }

    public function testGetLanguages()
    {
        $this->assertTrue(is_array($this->movie->getLanguages()));
        $this->assertSame(3, count($this->movie->getLanguages()));
        $this->assertSame(array('English', 'German', 'Italian'), $this->movie->getLanguages());
    }

    public function testGetColor()
    {
        $this->assertTrue(is_string($this->movie->getColor()));
        $this->assertSame('Color', $this->movie->getColor());
    }

    public function testGetRating()
    {
        $this->assertTrue(is_numeric($this->movie->getRating()));
        $this->assertSame(8.3, $this->movie->getRating());
    }

    public function testGetLength()
    {
        $this->assertTrue(is_int($this->movie->getLength()));
        $this->assertSame(131, $this->movie->getLength());
    }

    public function testGetTrailer()
    {
        $this->assertTrue(is_string($this->movie->getTrailer()));
        $this->assertSame('http://imdb.com/video/screenplay/vi581042457/', $this->movie->getTrailer());
    }

    public function tearDown()
    {
        $this->movie = null;
    }
}
