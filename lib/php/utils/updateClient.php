<?php declare(strict_types=1);

if (PHP_SAPI !== 'cli')
{
	echo "This script must be run in CLI\n";
	exit(1);
}

require __DIR__ . '/../../../vendor/autoload.php';


$filepath = realpath(__DIR__ . '/../../../joypixels.json');

$temp = json_decode(file_get_contents($filepath), true);

$clientFilepath = realpath(__DIR__ . '/../src/Client.php');

$old = file_get_contents($clientFilepath);

$revised = patchFile(
	$old,
	"/\\\$emojiVersion = \'\\K(\d+\.\d+(\.\d+)?)(?=\';)/",
	$temp['version']
);

echo ($revised !== $old) ? "Updated version\n" : "Version is already up to date\n";



// List of valid emoji sequences that should be matched
$matches = [];

// Add fully-qualified sequences from emoji.json
$filepath = realpath(__DIR__ . '/../../../emoji.json');
foreach (json_decode(file_get_contents($filepath), true) as $emoji)
{
	$matches[] = seqToUtf8($emoji['code_points']['fully_qualified']);
}

// The delimiter and modifiers should match what's used in toShort()
$builder = s9e\RegexpBuilder\Factory\PHP::getBuilder(
	modifiers: 'ui',
    delimiter: '/'
);
// The regexp is used as part of another. Marking it as not "standalone" will cause it to
// be wrapped in a non-capturing group so it doesn't interfere with other alternations
$builder->standalone = false;
$regexp = $builder->build($matches);

$new = patchFile(
	$revised,
	'/public \\$unicodeRegexp = \\K.*(?=;)/',
	var_export($regexp, true)
);

if ($new !== $revised)
{
	file_put_contents($clientFilepath, $new);
	echo sprintf('Patched %s%s', $clientFilepath, PHP_EOL);
}
else
{
	echo $clientFilepath . ' $unicodeRegexp is already up to date
';
}

/**
* @param string $old         String version of Client.php
* @param string $regexp      PCRE regexp used to match what needs to be patched
* @param string $replacement Literal string replacement
*/
function patchFile(string $old, string $regexp, string $replacement): string
{
	return preg_replace_callback(
		$regexp,
		fn(): string => $replacement,
		$old
	);
}

/**
* Convert a sequence of hex codes to UTF-8
*
* @param  string $seq Original sequence, e.g. "263a-fe0f"
* @return string      UTF-8 representation, e.g. "\u{263A}\u{FE0F}"
*/
function seqToUtf8(string $seq): string
{
	$str = '';
	foreach (preg_split('([-_ ])', $seq) as $hex)
	{
		$str .= IntlChar::chr(hexdec($hex));
	}

	return $str;
}