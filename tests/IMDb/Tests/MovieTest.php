<?php

namespace IMDb\Tests;

use IMDb\Movie;

class MovieTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Movie;
     */
    private $movie;

    public function setUp()
    {
        $this->movie = new Movie('0095016');
    }

    public function testGetId()
    {
        $this->assertTrue(is_numeric($this->movie->getId()));
        $this->assertEquals('0095016', $this->movie->getId());
    }

    public function testGetTitle()
    {
        $this->assertTrue(is_string($this->movie->getTitle()));
        $this->assertEquals('Die Hard', $this->movie->getTitle());
    }

    public function testGetYear()
    {
        $this->assertTrue(is_int($this->movie->getYear()));
        $this->assertEquals(1988, $this->movie->getYear());
    }

    public function testGetDirectors()
    {
        $this->assertTrue(is_array($this->movie->getDirectors()));
        $this->assertCount(1, $this->movie->getDirectors());
        $this->assertEquals(array('0001532' => 'John McTiernan'), $this->movie->getDirectors());
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
        $this->assertCount(2, $this->movie->getGenres());
        $this->assertEquals(array('Action', 'Thriller'), $this->movie->getGenres());
    }

    public function testGetLanguages()
    {
        $this->assertTrue(is_array($this->movie->getLanguages()));
        $this->assertCount(3, $this->movie->getLanguages());
        $this->assertEquals(array('English', 'German', 'Italian'), $this->movie->getLanguages());
    }

    public function testGetCountries()
    {
        $this->assertTrue(is_array($this->movie->getCountries()));
        $this->assertCount(1, $this->movie->getCountries());
        $this->assertEquals(array('USA'), $this->movie->getCountries());
    }

    public function testGetVotes()
    {
        $this->assertTrue(is_numeric($this->movie->getVotes()));
        $this->assertGreaterThanOrEqual(271945, $this->movie->getVotes());
    }

    public function testGetColor()
    {
        $this->assertTrue(is_string($this->movie->getColor()));
        $this->assertEquals('Color', $this->movie->getColor());
    }

    public function testGetRating()
    {
        $this->assertTrue(is_numeric($this->movie->getRating()));
        $this->assertEquals(8.3, $this->movie->getRating());
    }

    public function testGetLength()
    {
        $this->assertTrue(is_int($this->movie->getLength()));
        $this->assertEquals(131, $this->movie->getLength());
    }

    public function testGetTrailer()
    {
        $this->assertTrue(is_string($this->movie->getTrailer()));
        $this->assertEquals('http://imdb.com/video/screenplay/vi581042457/', $this->movie->getTrailer());
    }

    public function testGetPlot()
    {
        $this->assertTrue(is_string($this->movie->getPlot()));
        $this->assertEquals(
            'John McClane, officer of the NYPD, tries to save wife Holly Gennaro and several others, taken hostage by German terrorist Hans Gruber during a Christmas party at the Nakatomi Plaza in Los Angeles.',
            $this->movie->getPlot()
        );
    }

    public function tearDown()
    {
        $this->movie = null;
    }
}
