<?php declare(strict_types=1);

namespace JoyPixels\Test;

use PHPUnit\Framework\TestCase;
use JoyPixels\Client;
use JoyPixels\Ruleset;

final class ConversionTest extends TestCase
{

    private $emojiVersion;

    private \JoyPixels\Client $client;

    protected function setUp(): void
    {
        $this->client = new Client(new RuleSet());

        $file = __DIR__ . '/../../../joypixels.json';

        $string = file_get_contents($file);

        $json = json_decode($string);

        $this->emojiVersion = $json->version;
    }

    /**
     * test single unicode character
     */
    public function testSingleUnicodeCharacter(): void
    {
        $unicode     = '🐌';
        $shortname   = ':snail:';
        $mixed       = '🐌 :snail:';
        $image       = '<img class="joypixels" alt="&#x1f40c;" title=":snail:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f40c.png"/>';
        $mixedResult = $image . ' ' . $image;

        $this->assertEquals($shortname, $this->client->toShort($unicode));
        $this->assertEquals($image, $this->client->shortnameToImage($shortname));
        $this->assertEquals($unicode, $this->client->shortnameToUnicode($shortname));
        $this->assertEquals($image, $this->client->toImage($unicode));
        $this->assertEquals($image, $this->client->toImage($shortname));
        $this->assertEquals($mixedResult, $this->client->toImage($mixed));
    }

    /**
     * test three unicode characters together
     */
    public function testThreeUnicodeCharacters(): void
    {
        $unicode     = '👍🏻👍🏾👍🏿';
        $shortname   = ':thumbsup_tone1::thumbsup_tone4::thumbsup_tone5:';
        $image       = '<img class="joypixels" alt="&#x1f44d;&#x1f3fb;" title=":thumbsup_tone1:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f44d-1f3fb.png"/><img class="joypixels" alt="&#x1f44d;&#x1f3fe;" title=":thumbsup_tone4:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f44d-1f3fe.png"/><img class="joypixels" alt="&#x1f44d;&#x1f3ff;" title=":thumbsup_tone5:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f44d-1f3ff.png"/>';

        $this->assertEquals($shortname, $this->client->toShort($unicode));
        $this->assertEquals($unicode, $this->client->shortnameToUnicode($shortname));
        $this->assertEquals($image, $this->client->toImage($unicode));
    }

    /**
     * test the Spanish letter ñ in a shortname
     */
    public function testSpanishLetter_n(): void
    {
        $unicode     = '🪅';
        $shortname   = ':piñata:';
        $image       = '<img class="joypixels" alt="&#x1fa85;" title=":piñata:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1fa85.png"/>';

        $this->assertEquals($shortname, $this->client->toShort($unicode));
        $this->assertEquals($image, $this->client->shortnameToImage($shortname));
        $this->assertEquals($unicode, $this->client->shortnameToUnicode($shortname));
        $this->assertEquals($image, $this->client->toImage($shortname));
    }

    /**
     * test shortname mid sentence
     */
    public function testShortnameInsideSentence(): void
    {
        $unicode   = 'The 🦄 was EmojiOne\'s official mascot.';
        $shortname = "The :unicorn: was EmojiOne's official mascot.";
        $image     = 'The <img class="joypixels" alt="&#x1f984;" title=":unicorn:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f984.png"/> was EmojiOne\'s official mascot.';

        $this->assertEquals($shortname, $this->client->toShort($unicode));
        $this->assertEquals($image, $this->client->shortnameToImage($shortname));
        $this->assertEquals($unicode, $this->client->shortnameToUnicode($shortname));
        $this->assertEquals($image, $this->client->toImage($unicode));
        $this->assertEquals($image, $this->client->toImage($shortname));
    }

    /**
     * test shortname mid sentence with a trailing comma
     */
    public function testShortnameInsideSentenceWithComma(): void
    {
        $unicode   = 'The 🦄, was EmojiOne\'s official mascot.';
        $shortname = "The :unicorn:, was EmojiOne's official mascot.";
        $image     = 'The <img class="joypixels" alt="&#x1f984;" title=":unicorn:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f984.png"/>, was EmojiOne\'s official mascot.';

        $this->assertEquals($shortname, $this->client->toShort($unicode));
        $this->assertEquals($image, $this->client->shortnameToImage($shortname));
        $this->assertEquals($unicode, $this->client->shortnameToUnicode($shortname));
        $this->assertEquals($image, $this->client->toImage($unicode));
        $this->assertEquals($image, $this->client->toImage($shortname));
    }

    /**
     * test shortname at start of sentence
     */
    public function testShortnameAtStartOfSentence(): void
    {
        $unicode   = '🐌 mail.';
        $shortname = ':snail: mail.';
        $image     = '<img class="joypixels" alt="&#x1f40c;" title=":snail:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f40c.png"/> mail.';

        $this->assertEquals($shortname, $this->client->toShort($unicode));
        $this->assertEquals($image, $this->client->shortnameToImage($shortname));
        $this->assertEquals($unicode, $this->client->shortnameToUnicode($shortname));
        $this->assertEquals($image, $this->client->toImage($unicode));
        $this->assertEquals($image, $this->client->toImage($shortname));
    }

    /**
     * test shortname at start of sentence with apostrophe
     */
    public function testShortnameAtStartOfSentenceWithApostrophe(): void
    {
        $unicode   = '🐌\'s are cool!';
        $shortname = ":snail:'s are cool!";
        $image     = '<img class="joypixels" alt="&#x1f40c;" title=":snail:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f40c.png"/>\'s are cool!';

        $this->assertEquals($shortname, $this->client->toShort($unicode));
        $this->assertEquals($image, $this->client->shortnameToImage($shortname));
        $this->assertEquals($unicode, $this->client->shortnameToUnicode($shortname));
        $this->assertEquals($image, $this->client->toImage($unicode));
        $this->assertEquals($image, $this->client->toImage($shortname));
    }

    /**
     * test shortname at end of sentence
     */
    public function testShortnameAtEndOfSentence(): void
    {
        $unicode   = 'EmojiOne\'s official mascot was 🦄.';
        $shortname = "EmojiOne's official mascot was :unicorn:.";
        $image     = 'EmojiOne\'s official mascot was <img class="joypixels" alt="&#x1f984;" title=":unicorn:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f984.png"/>.';

        $this->assertEquals($shortname, $this->client->toShort($unicode));
        $this->assertEquals($image, $this->client->shortnameToImage($shortname));
        $this->assertEquals($unicode, $this->client->shortnameToUnicode($shortname));
        $this->assertEquals($image, $this->client->toImage($unicode));
        $this->assertEquals($image, $this->client->toImage($shortname));
    }

    /**
     * test shortname at end of sentence with alternate punctuation
     */
    public function testShortnameAtEndOfSentenceWithAlternatePunctuation(): void
    {
        $unicode   = 'EmojiOne\'s official mascot was 🦄!';
        $shortname = "EmojiOne's official mascot was :unicorn:!";
        $image     = 'EmojiOne\'s official mascot was <img class="joypixels" alt="&#x1f984;" title=":unicorn:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f984.png"/>!';

        $this->assertEquals($shortname, $this->client->toShort($unicode));
        $this->assertEquals($image, $this->client->shortnameToImage($shortname));
        $this->assertEquals($unicode, $this->client->shortnameToUnicode($shortname));
        $this->assertEquals($image, $this->client->toImage($unicode));
        $this->assertEquals($image, $this->client->toImage($shortname));
    }

    /**
     * test shortname at end of sentence with preceeding colon
     */
    public function testShortnameAtEndOfSentenceWithPreceedingColon(): void
    {
        $unicode   = 'EmojiOne\'s official mascot was: 🦄';
        $shortname = "EmojiOne's official mascot was: :unicorn:";
        $image     = 'EmojiOne\'s official mascot was: <img class="joypixels" alt="&#x1f984;" title=":unicorn:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f984.png"/>';

        $this->assertEquals($shortname, $this->client->toShort($unicode));
        $this->assertEquals($image, $this->client->shortnameToImage($shortname));
        $this->assertEquals($unicode, $this->client->shortnameToUnicode($shortname));
        $this->assertEquals($image, $this->client->toImage($unicode));
        $this->assertEquals($image, $this->client->toImage($shortname));
    }

    /**
     * shortname inside of IMG tag
     */
    public function testShortnameInsideOfImgTag(): void
    {
        $unicode   = 'The <img class="joypixels" alt="🦄" title=":unicorn:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f984.png" /> was EmojiOne\'s official mascot.';
        $shortname = 'The <img class="joypixels" alt=":unicorn:" title=":unicorn:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f984.png" /> was EmojiOne\'s official mascot.';

        $this->assertEquals($unicode, $this->client->toShort($unicode));
        $this->assertEquals($shortname, $this->client->shortnameToImage($shortname));
        $this->assertEquals($shortname, $this->client->shortnameToUnicode($shortname));
        $this->assertEquals($unicode, $this->client->toImage($unicode));
        $this->assertEquals($shortname, $this->client->toImage($shortname));
    }

    /**
     * test single ascii character
     */
    public function testSingleSmiley(): void
    {
        $this->client->ascii = true;

        $ascii       = ':-)';
        $unicode     = '🙂';
        $shortname   = ':slight_smile:';
        $image       = '<img class="joypixels" alt="&#x1f642;" title=":slight_smile:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f642.png"/>';

        $this->assertEquals($image, $this->client->shortnameToImage($shortname));
        $this->assertEquals($image, $this->client->shortnameToImage($ascii));
        $this->assertEquals($image, $this->client->toImage($shortname));
        $this->assertEquals($image, $this->client->toImage($ascii));
        $this->assertEquals(':]', $this->client->shortnameToAscii($shortname));
        $this->assertEquals($unicode, $this->client->unifyUnicode($ascii));
        $this->assertEquals($unicode, $this->client->unifyUnicode($shortname));
    }

    /**
     * test single smiley with incorrect case (shouldn't convert)
     */
    public function testSingleSmileyWithIncorrectCase(): void
    {
        $this->client->ascii = true;

        $ascii = ':d';

        $this->assertEquals($ascii, $this->client->shortnameToImage($ascii));
        $this->assertEquals($ascii, $this->client->toImage($ascii));
        $this->assertEquals($ascii, $this->client->unifyUnicode($ascii));
    }

    /**
     * test multiple smileys
     */
    public function testMultipleSmilies(): void
    {
        $this->client->ascii = true;

        // enable ascii match with leading/trailing space char
        $this->client->riskyMatchAscii = true;

        $ascii       = ';) :b :*';
        $ascii_fix   = ';^) :b :^*';
        $unicode     = '😉 😛 😘';
        $shortname   = ':wink: :stuck_out_tongue: :kissing_heart:';
        $image       = '<img class="joypixels" alt="&#x1f609;" title=":wink:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f609.png"/> <img class="joypixels" alt="&#x1f61b;" title=":stuck_out_tongue:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f61b.png"/> <img class="joypixels" alt="&#x1f618;" title=":kissing_heart:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f618.png"/>';

        $this->assertEquals($image, $this->client->shortnameToImage($shortname));
        $this->assertEquals($image, $this->client->shortnameToImage($ascii));
        $this->assertEquals($image, $this->client->toImage($shortname));
        $this->assertEquals($image, $this->client->toImage($ascii));
        $this->assertEquals($ascii_fix, $this->client->shortnameToAscii($shortname));
        $this->assertEquals($unicode, $this->client->unifyUnicode($ascii));
        $this->assertEquals($unicode, $this->client->unifyUnicode($shortname));
    }

    /**
     * test smiley to start a sentence
     */
    public function testSmileyAtSentenceStart(): void
    {
        $this->client->ascii = true;

        $ascii     = ':\\ is our confused smiley.';
        $ascii_fix = '=L is our confused smiley.';
        $unicode   = '😕 is our confused smiley.';
        $shortname = ':confused: is our confused smiley.';
        $image     = '<img class="joypixels" alt="&#x1f615;" title=":confused:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f615.png"/> is our confused smiley.';

        $this->assertEquals($image, $this->client->shortnameToImage($shortname));
        $this->assertEquals($image, $this->client->shortnameToImage($ascii));
        $this->assertEquals($image, $this->client->toImage($shortname));
        $this->assertEquals($image, $this->client->toImage($ascii));
        $this->assertEquals($ascii_fix, $this->client->shortnameToAscii($shortname));
        $this->assertEquals($unicode, $this->client->unifyUnicode($ascii));
        $this->assertEquals($unicode, $this->client->unifyUnicode($shortname));
    }

    /**
     * test smiley to end a sentence
     */
    public function testSmileyAtSentenceEnd(): void
    {
        $this->client->ascii = true;

        // enable ascii match with leading/trailing space char
        $this->client->riskyMatchAscii = true;

        $ascii     = "Our smiley to represent joy is :')";
        $ascii_fix = "Our smiley to represent joy is :'-)";
        $unicode   = 'Our smiley to represent joy is 😂';
        $shortname = 'Our smiley to represent joy is :joy:';
        $image     = 'Our smiley to represent joy is <img class="joypixels" alt="&#x1f602;" title=":joy:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f602.png"/>';

        $this->assertEquals($image, $this->client->shortnameToImage($shortname));
        $this->assertEquals($image, $this->client->shortnameToImage($ascii));
        $this->assertEquals($image, $this->client->toImage($shortname));
        $this->assertEquals($image, $this->client->toImage($ascii));
        $this->assertEquals($ascii_fix, $this->client->shortnameToAscii($shortname));
        $this->assertEquals($unicode, $this->client->unifyUnicode($ascii));
        $this->assertEquals($unicode, $this->client->unifyUnicode($shortname));
    }

    /**
     * test smiley to end a sentence with puncuation
     */
    public function testSmileyAtSentenceEndWithPunctuation(): void
    {
        $this->client->ascii = true;

        // enable ascii match with leading/trailing space char
        $this->client->riskyMatchAscii = true;

        $ascii     = "The reverse is the joy smiley is the cry smiley :'(.";
        $ascii_fix = 'The reverse is the joy smiley is the cry smiley ;-(.';
        $unicode   = 'The reverse is the joy smiley is the cry smiley 😢.';
        $shortname = 'The reverse is the joy smiley is the cry smiley :cry:.';
        $image     = 'The reverse is the joy smiley is the cry smiley <img class="joypixels" alt="&#x1f622;" title=":cry:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f622.png"/>.';

        $this->assertEquals($image, $this->client->shortnameToImage($shortname));
        $this->assertEquals($image, $this->client->shortnameToImage($ascii));
        $this->assertEquals($image, $this->client->toImage($shortname));
        $this->assertEquals($image, $this->client->toImage($ascii));
        $this->assertEquals($ascii_fix, $this->client->shortnameToAscii($shortname));
        $this->assertEquals($unicode, $this->client->unifyUnicode($ascii));
        $this->assertEquals($unicode, $this->client->unifyUnicode($shortname));
    }

    /**
     * test smiley to end a sentence with preceeding puncuration
     */
    public function testSmileyAtSentenceEndWithPreceedingPunctuation(): void
    {
        $this->client->ascii = true;

        // enable ascii match with leading/trailing space char
        $this->client->riskyMatchAscii = true;

        $ascii       = 'This is the "flushed" smiley: :$.';
        $ascii_fix   = 'This is the "flushed" smiley: =$.';
        $unicode     = 'This is the "flushed" smiley: 😳.';
        $shortname   = 'This is the "flushed" smiley: :flushed:.';
        $image       = 'This is the "flushed" smiley: <img class="joypixels" alt="&#x1f633;" title=":flushed:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f633.png"/>.';

        $this->assertEquals($image, $this->client->shortnameToImage($shortname));
        $this->assertEquals($image, $this->client->shortnameToImage($ascii));
        $this->assertEquals($image, $this->client->toImage($shortname));
        $this->assertEquals($image, $this->client->toImage($ascii));
        $this->assertEquals($ascii_fix, $this->client->shortnameToAscii($shortname));
        $this->assertEquals($unicode, $this->client->unifyUnicode($ascii));
        $this->assertEquals($unicode, $this->client->unifyUnicode($shortname));
    }

    /**
     * test smiley inside of an IMG tag  (shouldn't convert anything inside of the tag)
     */
    public function testSmileyInsideAnImgTag(): void
    {
        $this->client->ascii = true;

        $image = 'Smile <img class="joypixels" alt=":)" title=":smile:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f642.png" /> because it\'s going to be a good day.';

        $this->assertEquals($image, $this->client->shortnameToImage($image));
        $this->assertEquals($image, $this->client->toImage($image));
        $this->assertEquals($image, $this->client->shortnameToAscii($image));
        $this->assertEquals($image, $this->client->unifyUnicode($image));
    }

    /**
     * test typical username password fail  (shouldn't convert the user:pass, but should convert the last :p)
     */
    public function testTypicalUsernamePasswordFail(): void
    {
        $this->client->ascii = true;

        // enable ascii match with leading/trailing space char
        $this->client->riskyMatchAscii = true;

        $ascii       = 'Please log-in with user:pass as your credentials :P.';
        $ascii_fix   = 'Please log-in with user:pass as your credentials :b.';
        $unicode     = 'Please log-in with user:pass as your credentials 😛.';
        $shortname   = 'Please log-in with user:pass as your credentials :stuck_out_tongue:.';
        $image       = 'Please log-in with user:pass as your credentials <img class="joypixels" alt="&#x1f61b;" title=":stuck_out_tongue:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f61b.png"/>.';

        $this->assertEquals($image, $this->client->shortnameToImage($shortname));
        $this->assertEquals($image, $this->client->shortnameToImage($ascii));
        $this->assertEquals($image, $this->client->toImage($shortname));
        $this->assertEquals($image, $this->client->toImage($ascii));
        $this->assertEquals($ascii_fix, $this->client->shortnameToAscii($shortname));
        $this->assertEquals($unicode, $this->client->unifyUnicode($ascii));
        $this->assertEquals($unicode, $this->client->unifyUnicode($shortname));
    }

    /**
     * test shouldn't replace an ascii smiley in a URL (shouldn't replace :/)
     */
    public function testSmileyInAnUrl(): void
    {
        $this->client->ascii = true;

        $ascii = 'Check out https://www.joypixels.com';

        $this->assertEquals($ascii, $this->client->shortnameToImage($ascii));
        $this->assertEquals($ascii, $this->client->toImage($ascii));
        $this->assertEquals($ascii, $this->client->shortnameToAscii($ascii));
        $this->assertEquals($ascii, $this->client->unifyUnicode($ascii));
    }
}
