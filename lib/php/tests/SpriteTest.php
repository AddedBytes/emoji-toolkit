<?php declare(strict_types=1);

namespace JoyPixels\Test;

use PHPUnit\Framework\TestCase;
use JoyPixels\Client;
use JoyPixels\Ruleset;

final class SpriteTest extends TestCase
{

    private \JoyPixels\Client $client;

    protected function setUp(): void
    {
        $this->client = new Client(new Ruleset());
        $this->client->sprites = true;

        $file = __DIR__ . '/../../../joypixels.json';

        $string = file_get_contents($file);
        json_decode($string);
    }

    /**
     * test $this->client->toImage()
     */
    public function testToImage(): void
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! <span class="joypixels joypixels-32-people _1f604" title=":smile:">&#x1f604;</span> <span class="joypixels joypixels-32-people _1f604" title=":smile:">&#x1f604;</span>';

        $this->assertEquals($expected, $this->client->toImage($test));
    }

    /**
     * test $this->client->shortnameToImage()
     */
    public function testShortnameToImage(): void
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! 😄 <span class="joypixels joypixels-32-people _1f604" title=":smile:">&#x1f604;</span>';

        $this->assertEquals($expected, $this->client->shortnameToImage($test));
    }
}
