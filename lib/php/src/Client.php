<?php

declare(strict_types=1);

namespace JoyPixels;

/**
 * Client for JoyPixels
 */

class Client implements ClientInterface
{
    public bool $ascii = false;
     // convert ascii smileys?
    public bool $riskyMatchAscii = false;
     // set true to match ascii without leading/trailing space char
    public bool $shortcodes = true;
     // convert shortcodes?
    public bool $unicodeAlt = true;
     // use the unicode char as the alt attribute (makes copy and pasting the resulting text better)
    public string $emojiVersion = '9.0';

    public string $emojiSize = '32';
     // available sizes are '32', '64', and '128'
    public bool $greedyMatch = false;

    public bool $sprites = false;

    public mixed $spriteSize = '32';
     // available sizes are '32' and '64'
    /**
     * @var string
     */
    public string $imagePathPNG = 'https://cdn.jsdelivr.net/joypixels/assets';

    public string $fileExtension = '.png';

    public bool $imageTitleTag = true;

    public string $ignoredRegexp = '<object[^>]*>.*?<\/object>|<span[^>]*>.*?<\/span>|<(?:object|embed|svg|img|div|span|p|a)[^>]*>';

    public string $unicodeRegexp = '(?:[#*0-9]\\x{FE0F}\\x{20E3}?|[\\xA9\\xAE\\x{203C}\\x{2049}\\x{2122}\\x{2139}\\x{2194}-\\x{2199}\\x{21A9}\\x{21AA}\\x{2328}\\x{23CF}\\x{23ED}-\\x{23EF}\\x{23F1}\\x{23F2}\\x{23F8}-\\x{23FA}\\x{24C2}\\x{25AA}\\x{25AB}\\x{25B6}\\x{25C0}\\x{25FB}\\x{25FC}\\x{2600}-\\x{2604}\\x{260E}\\x{2611}\\x{2618}\\x{2620}\\x{2622}\\x{2623}\\x{2626}\\x{262A}\\x{262E}\\x{262F}\\x{2638}-\\x{263A}\\x{2640}\\x{2642}\\x{265F}\\x{2660}\\x{2663}\\x{2665}\\x{2666}\\x{2668}\\x{267B}\\x{267E}\\x{2692}\\x{2694}-\\x{2697}\\x{2699}\\x{269B}\\x{269C}\\x{26A0}\\x{26B0}\\x{26B1}\\x{26C8}\\x{26CF}\\x{26D1}\\x{26E9}\\x{26F0}\\x{26F1}\\x{26F4}\\x{26F7}\\x{26F8}\\x{2702}\\x{2708}\\x{2709}\\x{270F}\\x{2712}\\x{2714}\\x{2716}\\x{271D}\\x{2721}\\x{2733}\\x{2734}\\x{2744}\\x{2747}\\x{2763}\\x{27A1}\\x{2934}\\x{2935}\\x{2B05}-\\x{2B07}\\x{3030}\\x{303D}\\x{3297}\\x{3299}\\x{1F170}\\x{1F171}\\x{1F17E}\\x{1F17F}\\x{1F202}\\x{1F237}\\x{1F321}\\x{1F324}-\\x{1F32C}\\x{1F336}\\x{1F37D}\\x{1F396}\\x{1F397}\\x{1F399}-\\x{1F39B}\\x{1F39E}\\x{1F39F}\\x{1F3CD}\\x{1F3CE}\\x{1F3D4}-\\x{1F3DF}\\x{1F3F5}\\x{1F3F7}\\x{1F43F}\\x{1F4FD}\\x{1F549}\\x{1F54A}\\x{1F56F}\\x{1F570}\\x{1F573}\\x{1F576}-\\x{1F579}\\x{1F587}\\x{1F58A}-\\x{1F58D}\\x{1F5A5}\\x{1F5A8}\\x{1F5B1}\\x{1F5B2}\\x{1F5BC}\\x{1F5C2}-\\x{1F5C4}\\x{1F5D1}-\\x{1F5D3}\\x{1F5DC}-\\x{1F5DE}\\x{1F5E1}\\x{1F5E3}\\x{1F5E8}\\x{1F5EF}\\x{1F5F3}\\x{1F5FA}\\x{1F6CB}\\x{1F6CD}-\\x{1F6CF}\\x{1F6E0}-\\x{1F6E5}\\x{1F6E9}\\x{1F6F0}\\x{1F6F3}]\\x{FE0F}|[\\x{261D}\\x{270C}\\x{270D}\\x{1F574}\\x{1F590}][\\x{FE0F}\\x{1F3FB}-\\x{1F3FF}]|[\\x{26F9}\\x{1F3CB}\\x{1F3CC}\\x{1F575}][\\x{FE0F}\\x{1F3FB}-\\x{1F3FF}](?:\\x{200D}[\\x{2640}\\x{2642}]\\x{FE0F})?|[\\x{270A}\\x{270B}\\x{1F385}\\x{1F3C2}\\x{1F3C7}\\x{1F442}\\x{1F443}\\x{1F446}-\\x{1F450}\\x{1F466}\\x{1F467}\\x{1F46B}-\\x{1F46D}\\x{1F472}\\x{1F474}-\\x{1F476}\\x{1F478}\\x{1F47C}\\x{1F483}\\x{1F485}\\x{1F48F}\\x{1F491}\\x{1F4AA}\\x{1F57A}\\x{1F595}\\x{1F596}\\x{1F64C}\\x{1F64F}\\x{1F6C0}\\x{1F6CC}\\x{1F90C}\\x{1F90F}\\x{1F918}-\\x{1F91F}\\x{1F930}-\\x{1F934}\\x{1F936}\\x{1F977}\\x{1F9B5}\\x{1F9B6}\\x{1F9BB}\\x{1F9D2}\\x{1F9D3}\\x{1F9D5}\\x{1FAC3}-\\x{1FAC5}\\x{1FAF0}\\x{1FAF2}-\\x{1FAF8}][\\x{1F3FB}-\\x{1F3FF}]?|[\\x{1F3C3}\\x{1F6B6}\\x{1F9CE}][\\x{1F3FB}-\\x{1F3FF}]?(?:\\x{200D}(?:[\\x{2640}\\x{2642}]\\x{FE0F}(?:\\x{200D}\\x{27A1}\\x{FE0F})?|\\x{27A1}\\x{FE0F}))?|[\\x{1F3C4}\\x{1F3CA}\\x{1F46E}\\x{1F470}\\x{1F471}\\x{1F473}\\x{1F477}\\x{1F481}\\x{1F482}\\x{1F486}\\x{1F487}\\x{1F645}-\\x{1F647}\\x{1F64B}\\x{1F64D}\\x{1F64E}\\x{1F6A3}\\x{1F6B4}\\x{1F6B5}\\x{1F926}\\x{1F935}\\x{1F937}-\\x{1F939}\\x{1F93D}\\x{1F93E}\\x{1F9B8}\\x{1F9B9}\\x{1F9CD}\\x{1F9CF}\\x{1F9D4}\\x{1F9D6}-\\x{1F9DD}][\\x{1F3FB}-\\x{1F3FF}]?(?:\\x{200D}[\\x{2640}\\x{2642}]\\x{FE0F})?|[\\x{1F46F}\\x{1F93C}\\x{1F9DE}\\x{1F9DF}](?:\\x{200D}[\\x{2640}\\x{2642}]\\x{FE0F})?|[\\x{231A}\\x{231B}\\x{23E9}-\\x{23EC}\\x{23F0}\\x{23F3}\\x{25FD}\\x{25FE}\\x{2614}\\x{2615}\\x{2648}-\\x{2653}\\x{267F}\\x{2693}\\x{26A1}\\x{26A7}\\x{26AA}\\x{26AB}\\x{26BD}\\x{26BE}\\x{26C4}\\x{26C5}\\x{26CE}\\x{26D4}\\x{26EA}\\x{26F2}\\x{26F3}\\x{26F5}\\x{26FA}\\x{26FD}\\x{2705}\\x{2728}\\x{274C}\\x{274E}\\x{2753}-\\x{2755}\\x{2757}\\x{2795}-\\x{2797}\\x{27B0}\\x{27BF}\\x{2B1B}\\x{2B1C}\\x{2B50}\\x{2B55}\\x{1F004}\\x{1F0CF}\\x{1F18E}\\x{1F191}-\\x{1F19A}\\x{1F201}\\x{1F21A}\\x{1F22F}\\x{1F232}-\\x{1F236}\\x{1F238}-\\x{1F23A}\\x{1F250}\\x{1F251}\\x{1F300}-\\x{1F320}\\x{1F32D}-\\x{1F335}\\x{1F337}-\\x{1F343}\\x{1F345}-\\x{1F34A}\\x{1F34C}-\\x{1F37C}\\x{1F37E}-\\x{1F384}\\x{1F386}-\\x{1F393}\\x{1F3A0}-\\x{1F3C1}\\x{1F3C5}\\x{1F3C6}\\x{1F3C8}\\x{1F3C9}\\x{1F3CF}-\\x{1F3D3}\\x{1F3E0}-\\x{1F3F0}\\x{1F3F8}-\\x{1F407}\\x{1F409}-\\x{1F414}\\x{1F416}-\\x{1F425}\\x{1F427}-\\x{1F43A}\\x{1F43C}-\\x{1F43E}\\x{1F440}\\x{1F444}\\x{1F445}\\x{1F451}-\\x{1F465}\\x{1F46A}\\x{1F479}-\\x{1F47B}\\x{1F47D}-\\x{1F480}\\x{1F484}\\x{1F488}-\\x{1F48E}\\x{1F490}\\x{1F492}-\\x{1F4A9}\\x{1F4AB}-\\x{1F4FC}\\x{1F4FF}-\\x{1F53D}\\x{1F54B}-\\x{1F54E}\\x{1F550}-\\x{1F567}\\x{1F5A4}\\x{1F5FB}-\\x{1F62D}\\x{1F62F}-\\x{1F634}\\x{1F637}-\\x{1F641}\\x{1F643}\\x{1F644}\\x{1F648}-\\x{1F64A}\\x{1F680}-\\x{1F6A2}\\x{1F6A4}-\\x{1F6B3}\\x{1F6B7}-\\x{1F6BF}\\x{1F6C1}-\\x{1F6C5}\\x{1F6D0}-\\x{1F6D2}\\x{1F6D5}-\\x{1F6D7}\\x{1F6DC}-\\x{1F6DF}\\x{1F6EB}\\x{1F6EC}\\x{1F6F4}-\\x{1F6FC}\\x{1F7E0}-\\x{1F7EB}\\x{1F7F0}\\x{1F90D}\\x{1F90E}\\x{1F910}-\\x{1F917}\\x{1F920}-\\x{1F925}\\x{1F927}-\\x{1F92F}\\x{1F93A}\\x{1F93F}-\\x{1F945}\\x{1F947}-\\x{1F976}\\x{1F978}-\\x{1F9B4}\\x{1F9B7}\\x{1F9BA}\\x{1F9BC}-\\x{1F9CC}\\x{1F9D0}\\x{1F9E0}-\\x{1F9FF}\\x{1FA70}-\\x{1FA7C}\\x{1FA80}-\\x{1FA88}\\x{1FA90}-\\x{1FABD}\\x{1FABF}-\\x{1FAC2}\\x{1FACE}-\\x{1FADB}\\x{1FAE0}-\\x{1FAE8}]|\\x{26D3}\\x{FE0F}(?:\\x{200D}\\x{1F4A5})?|\\x{2764}\\x{FE0F}(?:\\x{200D}[\\x{1F525}\\x{1FA79}])?|\\x{1F1E6}[\\x{1F1E8}-\\x{1F1EC}\\x{1F1EE}\\x{1F1F1}\\x{1F1F2}\\x{1F1F4}\\x{1F1F6}-\\x{1F1FA}\\x{1F1FC}\\x{1F1FD}\\x{1F1FF}]?|\\x{1F1E7}[\\x{1F1E6}\\x{1F1E7}\\x{1F1E9}-\\x{1F1EF}\\x{1F1F1}-\\x{1F1F4}\\x{1F1F6}-\\x{1F1F9}\\x{1F1FB}\\x{1F1FC}\\x{1F1FE}\\x{1F1FF}]?|\\x{1F1E8}[\\x{1F1E6}\\x{1F1E8}\\x{1F1E9}\\x{1F1EB}-\\x{1F1EE}\\x{1F1F0}-\\x{1F1F5}\\x{1F1F7}\\x{1F1FA}-\\x{1F1FF}]?|\\x{1F1E9}[\\x{1F1EA}\\x{1F1EC}\\x{1F1EF}\\x{1F1F0}\\x{1F1F2}\\x{1F1F4}\\x{1F1FF}]?|\\x{1F1EA}[\\x{1F1E6}\\x{1F1E8}\\x{1F1EA}\\x{1F1EC}\\x{1F1ED}\\x{1F1F7}-\\x{1F1FA}]?|\\x{1F1EB}[\\x{1F1EE}-\\x{1F1F0}\\x{1F1F2}\\x{1F1F4}\\x{1F1F7}]?|\\x{1F1EC}[\\x{1F1E6}\\x{1F1E7}\\x{1F1E9}-\\x{1F1EE}\\x{1F1F1}-\\x{1F1F3}\\x{1F1F5}-\\x{1F1FA}\\x{1F1FC}\\x{1F1FE}]?|\\x{1F1ED}[\\x{1F1F0}\\x{1F1F2}\\x{1F1F3}\\x{1F1F7}\\x{1F1F9}\\x{1F1FA}]?|\\x{1F1EE}[\\x{1F1E8}-\\x{1F1EA}\\x{1F1F1}-\\x{1F1F4}\\x{1F1F6}-\\x{1F1F9}]?|\\x{1F1EF}[\\x{1F1EA}\\x{1F1F2}\\x{1F1F4}\\x{1F1F5}]?|\\x{1F1F0}[\\x{1F1EA}\\x{1F1EC}-\\x{1F1EE}\\x{1F1F2}\\x{1F1F3}\\x{1F1F5}\\x{1F1F7}\\x{1F1FC}\\x{1F1FE}\\x{1F1FF}]?|\\x{1F1F1}[\\x{1F1E6}-\\x{1F1E8}\\x{1F1EE}\\x{1F1F0}\\x{1F1F7}-\\x{1F1FB}\\x{1F1FE}]?|\\x{1F1F2}[\\x{1F1E6}\\x{1F1E8}-\\x{1F1ED}\\x{1F1F0}-\\x{1F1FF}]?|\\x{1F1F3}[\\x{1F1E6}\\x{1F1E8}\\x{1F1EA}-\\x{1F1EC}\\x{1F1EE}\\x{1F1F1}\\x{1F1F4}\\x{1F1F5}\\x{1F1F7}\\x{1F1FA}\\x{1F1FF}]?|\\x{1F1F4}\\x{1F1F2}?|\\x{1F1F5}[\\x{1F1E6}\\x{1F1EA}-\\x{1F1ED}\\x{1F1F0}-\\x{1F1F3}\\x{1F1F7}-\\x{1F1F9}\\x{1F1FC}\\x{1F1FE}]?|\\x{1F1F6}\\x{1F1E6}?|\\x{1F1F7}[\\x{1F1EA}\\x{1F1F4}\\x{1F1F8}\\x{1F1FA}\\x{1F1FC}]?|\\x{1F1F8}[\\x{1F1E6}-\\x{1F1EA}\\x{1F1EC}-\\x{1F1F4}\\x{1F1F7}-\\x{1F1F9}\\x{1F1FB}\\x{1F1FD}-\\x{1F1FF}]?|\\x{1F1F9}[\\x{1F1E6}\\x{1F1E8}\\x{1F1E9}\\x{1F1EB}-\\x{1F1ED}\\x{1F1EF}-\\x{1F1F4}\\x{1F1F7}\\x{1F1F9}\\x{1F1FB}\\x{1F1FC}\\x{1F1FF}]?|\\x{1F1FA}[\\x{1F1E6}\\x{1F1EC}\\x{1F1F2}\\x{1F1F3}\\x{1F1F8}\\x{1F1FE}\\x{1F1FF}]?|\\x{1F1FB}[\\x{1F1E6}\\x{1F1E8}\\x{1F1EA}\\x{1F1EC}\\x{1F1EE}\\x{1F1F3}\\x{1F1FA}]?|\\x{1F1FC}[\\x{1F1EB}\\x{1F1F8}]?|\\x{1F1FD}\\x{1F1F0}?|\\x{1F1FE}[\\x{1F1EA}\\x{1F1F9}]?|\\x{1F1FF}[\\x{1F1E6}\\x{1F1F2}\\x{1F1FC}]?|\\x{1F344}(?:\\x{200D}\\x{1F7EB})?|\\x{1F34B}(?:\\x{200D}\\x{1F7E9})?|\\x{1F3F3}\\x{FE0F}(?:\\x{200D}(?:\\x{26A7}\\x{FE0F}|\\x{1F308}))?|\\x{1F3F4}(?:\\x{200D}\\x{2620}\\x{FE0F}|\\x{E0067}\\x{E0062}(?:\\x{E0065}\\x{E006E}\\x{E0067}|\\x{E0073}\\x{E0063}\\x{E0074}|\\x{E0077}\\x{E006C}\\x{E0073})\\x{E007F})?|\\x{1F408}(?:\\x{200D}\\x{2B1B})?|\\x{1F415}(?:\\x{200D}\\x{1F9BA})?|\\x{1F426}(?:\\x{200D}[\\x{2B1B}\\x{1F525}])?|\\x{1F43B}(?:\\x{200D}\\x{2744}\\x{FE0F})?|\\x{1F441}\\x{FE0F}(?:\\x{200D}\\x{1F5E8}\\x{FE0F})?|\\x{1F468}(?:\\x{200D}(?:[\\x{2695}\\x{2696}\\x{2708}]\\x{FE0F}|[\\x{1F468}\\x{1F469}]\\x{200D}(?:\\x{1F466}(?:\\x{200D}\\x{1F466})?|\\x{1F467}(?:\\x{200D}[\\x{1F466}\\x{1F467}])?)|[\\x{1F9AF}\\x{1F9BC}\\x{1F9BD}](?:\\x{200D}\\x{27A1}\\x{FE0F})?|[\\x{1F33E}\\x{1F373}\\x{1F37C}\\x{1F393}\\x{1F3A4}\\x{1F3A8}\\x{1F3EB}\\x{1F3ED}\\x{1F4BB}\\x{1F4BC}\\x{1F527}\\x{1F52C}\\x{1F680}\\x{1F692}\\x{1F9B0}-\\x{1F9B3}]|\\x{2764}\\x{FE0F}\\x{200D}(?:\\x{1F48B}\\x{200D})?\\x{1F468}|\\x{1F466}(?:\\x{200D}\\x{1F466})?|\\x{1F467}(?:\\x{200D}[\\x{1F466}\\x{1F467}])?)|\\x{1F3FB}(?:\\x{200D}(?:[\\x{2695}\\x{2696}\\x{2708}]\\x{FE0F}|[\\x{1F9AF}\\x{1F9BC}\\x{1F9BD}](?:\\x{200D}\\x{27A1}\\x{FE0F})?|[\\x{1F33E}\\x{1F373}\\x{1F37C}\\x{1F393}\\x{1F3A4}\\x{1F3A8}\\x{1F3EB}\\x{1F3ED}\\x{1F4BB}\\x{1F4BC}\\x{1F527}\\x{1F52C}\\x{1F680}\\x{1F692}\\x{1F9B0}-\\x{1F9B3}]|\\x{2764}\\x{FE0F}\\x{200D}(?:\\x{1F48B}\\x{200D})?\\x{1F468}[\\x{1F3FB}-\\x{1F3FF}]|\\x{1F91D}\\x{200D}\\x{1F468}[\\x{1F3FC}-\\x{1F3FF}]))?|\\x{1F3FC}(?:\\x{200D}(?:[\\x{2695}\\x{2696}\\x{2708}]\\x{FE0F}|[\\x{1F9AF}\\x{1F9BC}\\x{1F9BD}](?:\\x{200D}\\x{27A1}\\x{FE0F})?|[\\x{1F33E}\\x{1F373}\\x{1F37C}\\x{1F393}\\x{1F3A4}\\x{1F3A8}\\x{1F3EB}\\x{1F3ED}\\x{1F4BB}\\x{1F4BC}\\x{1F527}\\x{1F52C}\\x{1F680}\\x{1F692}\\x{1F9B0}-\\x{1F9B3}]|\\x{2764}\\x{FE0F}\\x{200D}(?:\\x{1F48B}\\x{200D})?\\x{1F468}[\\x{1F3FB}-\\x{1F3FF}]|\\x{1F91D}\\x{200D}\\x{1F468}[\\x{1F3FB}\\x{1F3FD}-\\x{1F3FF}]))?|\\x{1F3FD}(?:\\x{200D}(?:[\\x{2695}\\x{2696}\\x{2708}]\\x{FE0F}|[\\x{1F9AF}\\x{1F9BC}\\x{1F9BD}](?:\\x{200D}\\x{27A1}\\x{FE0F})?|[\\x{1F33E}\\x{1F373}\\x{1F37C}\\x{1F393}\\x{1F3A4}\\x{1F3A8}\\x{1F3EB}\\x{1F3ED}\\x{1F4BB}\\x{1F4BC}\\x{1F527}\\x{1F52C}\\x{1F680}\\x{1F692}\\x{1F9B0}-\\x{1F9B3}]|\\x{2764}\\x{FE0F}\\x{200D}(?:\\x{1F48B}\\x{200D})?\\x{1F468}[\\x{1F3FB}-\\x{1F3FF}]|\\x{1F91D}\\x{200D}\\x{1F468}[\\x{1F3FB}\\x{1F3FC}\\x{1F3FE}\\x{1F3FF}]))?|\\x{1F3FE}(?:\\x{200D}(?:[\\x{2695}\\x{2696}\\x{2708}]\\x{FE0F}|[\\x{1F9AF}\\x{1F9BC}\\x{1F9BD}](?:\\x{200D}\\x{27A1}\\x{FE0F})?|[\\x{1F33E}\\x{1F373}\\x{1F37C}\\x{1F393}\\x{1F3A4}\\x{1F3A8}\\x{1F3EB}\\x{1F3ED}\\x{1F4BB}\\x{1F4BC}\\x{1F527}\\x{1F52C}\\x{1F680}\\x{1F692}\\x{1F9B0}-\\x{1F9B3}]|\\x{2764}\\x{FE0F}\\x{200D}(?:\\x{1F48B}\\x{200D})?\\x{1F468}[\\x{1F3FB}-\\x{1F3FF}]|\\x{1F91D}\\x{200D}\\x{1F468}[\\x{1F3FB}-\\x{1F3FD}\\x{1F3FF}]))?|\\x{1F3FF}(?:\\x{200D}(?:[\\x{2695}\\x{2696}\\x{2708}]\\x{FE0F}|[\\x{1F9AF}\\x{1F9BC}\\x{1F9BD}](?:\\x{200D}\\x{27A1}\\x{FE0F})?|[\\x{1F33E}\\x{1F373}\\x{1F37C}\\x{1F393}\\x{1F3A4}\\x{1F3A8}\\x{1F3EB}\\x{1F3ED}\\x{1F4BB}\\x{1F4BC}\\x{1F527}\\x{1F52C}\\x{1F680}\\x{1F692}\\x{1F9B0}-\\x{1F9B3}]|\\x{2764}\\x{FE0F}\\x{200D}(?:\\x{1F48B}\\x{200D})?\\x{1F468}[\\x{1F3FB}-\\x{1F3FF}]|\\x{1F91D}\\x{200D}\\x{1F468}[\\x{1F3FB}-\\x{1F3FE}]))?)?|\\x{1F469}(?:\\x{200D}(?:[\\x{2695}\\x{2696}\\x{2708}]\\x{FE0F}|[\\x{1F9AF}\\x{1F9BC}\\x{1F9BD}](?:\\x{200D}\\x{27A1}\\x{FE0F})?|[\\x{1F33E}\\x{1F373}\\x{1F37C}\\x{1F393}\\x{1F3A4}\\x{1F3A8}\\x{1F3EB}\\x{1F3ED}\\x{1F4BB}\\x{1F4BC}\\x{1F527}\\x{1F52C}\\x{1F680}\\x{1F692}\\x{1F9B0}-\\x{1F9B3}]|\\x{2764}\\x{FE0F}\\x{200D}(?:\\x{1F48B}\\x{200D})?[\\x{1F468}\\x{1F469}]|\\x{1F466}(?:\\x{200D}\\x{1F466})?|\\x{1F467}(?:\\x{200D}[\\x{1F466}\\x{1F467}])?|\\x{1F469}\\x{200D}(?:\\x{1F466}(?:\\x{200D}\\x{1F466})?|\\x{1F467}(?:\\x{200D}[\\x{1F466}\\x{1F467}])?))|\\x{1F3FB}(?:\\x{200D}(?:[\\x{2695}\\x{2696}\\x{2708}]\\x{FE0F}|[\\x{1F9AF}\\x{1F9BC}\\x{1F9BD}](?:\\x{200D}\\x{27A1}\\x{FE0F})?|[\\x{1F33E}\\x{1F373}\\x{1F37C}\\x{1F393}\\x{1F3A4}\\x{1F3A8}\\x{1F3EB}\\x{1F3ED}\\x{1F4BB}\\x{1F4BC}\\x{1F527}\\x{1F52C}\\x{1F680}\\x{1F692}\\x{1F9B0}-\\x{1F9B3}]|\\x{2764}\\x{FE0F}\\x{200D}(?:[\\x{1F468}\\x{1F469}]|\\x{1F48B}\\x{200D}[\\x{1F468}\\x{1F469}])[\\x{1F3FB}-\\x{1F3FF}]|\\x{1F91D}\\x{200D}[\\x{1F468}\\x{1F469}][\\x{1F3FC}-\\x{1F3FF}]))?|\\x{1F3FC}(?:\\x{200D}(?:[\\x{2695}\\x{2696}\\x{2708}]\\x{FE0F}|[\\x{1F9AF}\\x{1F9BC}\\x{1F9BD}](?:\\x{200D}\\x{27A1}\\x{FE0F})?|[\\x{1F33E}\\x{1F373}\\x{1F37C}\\x{1F393}\\x{1F3A4}\\x{1F3A8}\\x{1F3EB}\\x{1F3ED}\\x{1F4BB}\\x{1F4BC}\\x{1F527}\\x{1F52C}\\x{1F680}\\x{1F692}\\x{1F9B0}-\\x{1F9B3}]|\\x{2764}\\x{FE0F}\\x{200D}(?:[\\x{1F468}\\x{1F469}]|\\x{1F48B}\\x{200D}[\\x{1F468}\\x{1F469}])[\\x{1F3FB}-\\x{1F3FF}]|\\x{1F91D}\\x{200D}[\\x{1F468}\\x{1F469}][\\x{1F3FB}\\x{1F3FD}-\\x{1F3FF}]))?|\\x{1F3FD}(?:\\x{200D}(?:[\\x{2695}\\x{2696}\\x{2708}]\\x{FE0F}|[\\x{1F9AF}\\x{1F9BC}\\x{1F9BD}](?:\\x{200D}\\x{27A1}\\x{FE0F})?|[\\x{1F33E}\\x{1F373}\\x{1F37C}\\x{1F393}\\x{1F3A4}\\x{1F3A8}\\x{1F3EB}\\x{1F3ED}\\x{1F4BB}\\x{1F4BC}\\x{1F527}\\x{1F52C}\\x{1F680}\\x{1F692}\\x{1F9B0}-\\x{1F9B3}]|\\x{2764}\\x{FE0F}\\x{200D}(?:[\\x{1F468}\\x{1F469}]|\\x{1F48B}\\x{200D}[\\x{1F468}\\x{1F469}])[\\x{1F3FB}-\\x{1F3FF}]|\\x{1F91D}\\x{200D}[\\x{1F468}\\x{1F469}][\\x{1F3FB}\\x{1F3FC}\\x{1F3FE}\\x{1F3FF}]))?|\\x{1F3FE}(?:\\x{200D}(?:[\\x{2695}\\x{2696}\\x{2708}]\\x{FE0F}|[\\x{1F9AF}\\x{1F9BC}\\x{1F9BD}](?:\\x{200D}\\x{27A1}\\x{FE0F})?|[\\x{1F33E}\\x{1F373}\\x{1F37C}\\x{1F393}\\x{1F3A4}\\x{1F3A8}\\x{1F3EB}\\x{1F3ED}\\x{1F4BB}\\x{1F4BC}\\x{1F527}\\x{1F52C}\\x{1F680}\\x{1F692}\\x{1F9B0}-\\x{1F9B3}]|\\x{2764}\\x{FE0F}\\x{200D}(?:[\\x{1F468}\\x{1F469}]|\\x{1F48B}\\x{200D}[\\x{1F468}\\x{1F469}])[\\x{1F3FB}-\\x{1F3FF}]|\\x{1F91D}\\x{200D}[\\x{1F468}\\x{1F469}][\\x{1F3FB}-\\x{1F3FD}\\x{1F3FF}]))?|\\x{1F3FF}(?:\\x{200D}(?:[\\x{2695}\\x{2696}\\x{2708}]\\x{FE0F}|[\\x{1F9AF}\\x{1F9BC}\\x{1F9BD}](?:\\x{200D}\\x{27A1}\\x{FE0F})?|[\\x{1F33E}\\x{1F373}\\x{1F37C}\\x{1F393}\\x{1F3A4}\\x{1F3A8}\\x{1F3EB}\\x{1F3ED}\\x{1F4BB}\\x{1F4BC}\\x{1F527}\\x{1F52C}\\x{1F680}\\x{1F692}\\x{1F9B0}-\\x{1F9B3}]|\\x{2764}\\x{FE0F}\\x{200D}(?:[\\x{1F468}\\x{1F469}]|\\x{1F48B}\\x{200D}[\\x{1F468}\\x{1F469}])[\\x{1F3FB}-\\x{1F3FF}]|\\x{1F91D}\\x{200D}[\\x{1F468}\\x{1F469}][\\x{1F3FB}-\\x{1F3FE}]))?)?|\\x{1F62E}(?:\\x{200D}\\x{1F4A8})?|\\x{1F635}(?:\\x{200D}\\x{1F4AB})?|\\x{1F636}(?:\\x{200D}\\x{1F32B}\\x{FE0F})?|\\x{1F642}(?:\\x{200D}[\\x{2194}\\x{2195}]\\x{FE0F})?|\\x{1F9D1}(?:\\x{200D}(?:[\\x{2695}\\x{2696}\\x{2708}]\\x{FE0F}|[\\x{1F9AF}\\x{1F9BC}\\x{1F9BD}](?:\\x{200D}\\x{27A1}\\x{FE0F})?|[\\x{1F33E}\\x{1F373}\\x{1F37C}\\x{1F384}\\x{1F393}\\x{1F3A4}\\x{1F3A8}\\x{1F3EB}\\x{1F3ED}\\x{1F4BB}\\x{1F4BC}\\x{1F527}\\x{1F52C}\\x{1F680}\\x{1F692}\\x{1F9B0}-\\x{1F9B3}]|\\x{1F91D}\\x{200D}\\x{1F9D1}|\\x{1F9D1}\\x{200D}\\x{1F9D2}(?:\\x{200D}\\x{1F9D2})?|\\x{1F9D2}(?:\\x{200D}\\x{1F9D2})?)|\\x{1F3FB}(?:\\x{200D}(?:[\\x{2695}\\x{2696}\\x{2708}]\\x{FE0F}|[\\x{1F9AF}\\x{1F9BC}\\x{1F9BD}](?:\\x{200D}\\x{27A1}\\x{FE0F})?|[\\x{1F33E}\\x{1F373}\\x{1F37C}\\x{1F384}\\x{1F393}\\x{1F3A4}\\x{1F3A8}\\x{1F3EB}\\x{1F3ED}\\x{1F4BB}\\x{1F4BC}\\x{1F527}\\x{1F52C}\\x{1F680}\\x{1F692}\\x{1F9B0}-\\x{1F9B3}]|\\x{2764}\\x{FE0F}\\x{200D}(?:\\x{1F48B}\\x{200D})?\\x{1F9D1}[\\x{1F3FC}-\\x{1F3FF}]|\\x{1F91D}\\x{200D}\\x{1F9D1}[\\x{1F3FB}-\\x{1F3FF}]))?|\\x{1F3FC}(?:\\x{200D}(?:[\\x{2695}\\x{2696}\\x{2708}]\\x{FE0F}|[\\x{1F9AF}\\x{1F9BC}\\x{1F9BD}](?:\\x{200D}\\x{27A1}\\x{FE0F})?|[\\x{1F33E}\\x{1F373}\\x{1F37C}\\x{1F384}\\x{1F393}\\x{1F3A4}\\x{1F3A8}\\x{1F3EB}\\x{1F3ED}\\x{1F4BB}\\x{1F4BC}\\x{1F527}\\x{1F52C}\\x{1F680}\\x{1F692}\\x{1F9B0}-\\x{1F9B3}]|\\x{2764}\\x{FE0F}\\x{200D}(?:\\x{1F48B}\\x{200D})?\\x{1F9D1}[\\x{1F3FB}\\x{1F3FD}-\\x{1F3FF}]|\\x{1F91D}\\x{200D}\\x{1F9D1}[\\x{1F3FB}-\\x{1F3FF}]))?|\\x{1F3FD}(?:\\x{200D}(?:[\\x{2695}\\x{2696}\\x{2708}]\\x{FE0F}|[\\x{1F9AF}\\x{1F9BC}\\x{1F9BD}](?:\\x{200D}\\x{27A1}\\x{FE0F})?|[\\x{1F33E}\\x{1F373}\\x{1F37C}\\x{1F384}\\x{1F393}\\x{1F3A4}\\x{1F3A8}\\x{1F3EB}\\x{1F3ED}\\x{1F4BB}\\x{1F4BC}\\x{1F527}\\x{1F52C}\\x{1F680}\\x{1F692}\\x{1F9B0}-\\x{1F9B3}]|\\x{2764}\\x{FE0F}\\x{200D}(?:\\x{1F48B}\\x{200D})?\\x{1F9D1}[\\x{1F3FB}\\x{1F3FC}\\x{1F3FE}\\x{1F3FF}]|\\x{1F91D}\\x{200D}\\x{1F9D1}[\\x{1F3FB}-\\x{1F3FF}]))?|\\x{1F3FE}(?:\\x{200D}(?:[\\x{2695}\\x{2696}\\x{2708}]\\x{FE0F}|[\\x{1F9AF}\\x{1F9BC}\\x{1F9BD}](?:\\x{200D}\\x{27A1}\\x{FE0F})?|[\\x{1F33E}\\x{1F373}\\x{1F37C}\\x{1F384}\\x{1F393}\\x{1F3A4}\\x{1F3A8}\\x{1F3EB}\\x{1F3ED}\\x{1F4BB}\\x{1F4BC}\\x{1F527}\\x{1F52C}\\x{1F680}\\x{1F692}\\x{1F9B0}-\\x{1F9B3}]|\\x{2764}\\x{FE0F}\\x{200D}(?:\\x{1F48B}\\x{200D})?\\x{1F9D1}[\\x{1F3FB}-\\x{1F3FD}\\x{1F3FF}]|\\x{1F91D}\\x{200D}\\x{1F9D1}[\\x{1F3FB}-\\x{1F3FF}]))?|\\x{1F3FF}(?:\\x{200D}(?:[\\x{2695}\\x{2696}\\x{2708}]\\x{FE0F}|[\\x{1F9AF}\\x{1F9BC}\\x{1F9BD}](?:\\x{200D}\\x{27A1}\\x{FE0F})?|[\\x{1F33E}\\x{1F373}\\x{1F37C}\\x{1F384}\\x{1F393}\\x{1F3A4}\\x{1F3A8}\\x{1F3EB}\\x{1F3ED}\\x{1F4BB}\\x{1F4BC}\\x{1F527}\\x{1F52C}\\x{1F680}\\x{1F692}\\x{1F9B0}-\\x{1F9B3}]|\\x{2764}\\x{FE0F}\\x{200D}(?:\\x{1F48B}\\x{200D})?\\x{1F9D1}[\\x{1F3FB}-\\x{1F3FE}]|\\x{1F91D}\\x{200D}\\x{1F9D1}[\\x{1F3FB}-\\x{1F3FF}]))?)?|\\x{1FAF1}(?:\\x{1F3FB}(?:\\x{200D}\\x{1FAF2}[\\x{1F3FC}-\\x{1F3FF}])?|\\x{1F3FC}(?:\\x{200D}\\x{1FAF2}[\\x{1F3FB}\\x{1F3FD}-\\x{1F3FF}])?|\\x{1F3FD}(?:\\x{200D}\\x{1FAF2}[\\x{1F3FB}\\x{1F3FC}\\x{1F3FE}\\x{1F3FF}])?|\\x{1F3FE}(?:\\x{200D}\\x{1FAF2}[\\x{1F3FB}-\\x{1F3FD}\\x{1F3FF}])?|\\x{1F3FF}(?:\\x{200D}\\x{1FAF2}[\\x{1F3FB}-\\x{1F3FE}])?)?)';

    public string $shortcodeRegexp = ':([-+\\w]+):';

    protected RulesetInterface $ruleset;

    public function __construct(?RulesetInterface $ruleset = null)
    {
        if ( ! is_null($ruleset) )
        {
            $this->ruleset = $ruleset;
        }

        $this->imagePathPNG = $this->imagePathPNG . '/' . $this->emojiVersion . '/png/unicode/' . $this->emojiSize . '/';
        $this->spriteSize = ($this->spriteSize == '32' || $this->spriteSize == '64') ? $this->spriteSize : '32';
    }

    // ##########################################
    // ######## core methods
    // ##########################################

    /**
     * First pass changes unicode characters into emoji shortnames.
     * Second pass changes shortnames into emoji markup.
     *
     * @param   string  $string The input string.
     * @return  string  String with appropriate html for rendering emoji.
     */
    public function toImage($string): string
    {
        $string = $this->toShort($string);
        return $this->shortnameToImage($string);
    }

    /**
     * Uses toShort to transform all unicode into a standard shortname
     * then transforms the shortname into unicode.
     * This is done for standardization when converting several unicode types.
     *
     * @param   string  $string The input string.
     * @return  string  String with standardized unicode.
     */
    public function unifyUnicode($string): string
    {
        $string = $this->toShort($string);
        return $this->shortnameToUnicode($string);
    }

    /**
     * This will output unicode from shortname input.
     * If Client/$ascii is true it will also output unicode from ascii.
     * This is useful for sending emojis back to mobile devices.
     *
     * @param   string  $string The input string.
     * @return  string  String with unicode replacements.
     */
    public function shortnameToUnicode($string): string
    {
        if ($this->shortcodes)
        {
            $string = preg_replace_callback('/'.$this->ignoredRegexp.'|('.$this->shortcodeRegexp.')/Siu', $this->shortnameToUnicodeCallback(...), $string);
        }

        if ($this->ascii)
        {
            $ruleset = $this->getRuleset();
            $asciiRegexp = $ruleset->getAsciiRegexp();
            $asciiRX = ($this->riskyMatchAscii) ? '|(()'.$asciiRegexp.'())' : '|((\\s|^)'.$asciiRegexp.'(?=\\s|$|[!,.?]))';

            $string = preg_replace_callback('/'.$this->ignoredRegexp.$asciiRX.'/S', $this->asciiToUnicodeCallback(...), (string) $string);
        }

        return $string;
    }

    /**
     * This will replace shortnames with their ascii equivalent.
     * ex. :wink: --> ;^)
     * This is useful for systems that don't support unicode or images.
     *
     * @param   string  $string The input string.
     * @return  string  String with ascii replacements.
     */
    public function shortnameToAscii($string): ?string
    {
        return preg_replace_callback('/'.$this->ignoredRegexp.'|('.$this->shortcodeRegexp.')/Siu', $this->shortnameToAsciiCallback(...), $string);
    }

    /**
     * This will replace ascii with their shortname equivalent, it bases on reversed ::shortnameToAsciiCallback
     * ex. :) --> :slight_smile:
     * This is useful for systems that don't ascii emoji.
     *
     * @param string $string The input ascii.
     * @return  string  String with shortname replacements.
     */
    public function asciiToShortname(string $string): ?string
    {
        $ruleset = $this->getRuleset();
        $asciiRegexp = $ruleset->getAsciiRegexp();
        $asciiRX = ($this->riskyMatchAscii) ? '|(()'.$asciiRegexp.'())' : '|((\\s|^)'.$asciiRegexp.'(?=\\s|$|[!,.?]))';

        return preg_replace_callback('/'.$this->ignoredRegexp.$asciiRX.'/S', $this->asciiToShortnameCallback(...), $string);
    }

    /**
     * This will output image markup from shortname input.
     *
     * @param   string  $string The input string.
     * @return  string  String with appropriate html for rendering emoji.
     */
    public function shortnameToImage($string): string
    {
        if ($this->shortcodes)
        {
            $string = preg_replace_callback('/'.$this->ignoredRegexp.'|('.$this->shortcodeRegexp.')/Siu', $this->shortnameToImageCallback(...), $string);
        }

        if ($this->ascii)
        {
            $ruleset = $this->getRuleset();
            $asciiRegexp = $ruleset->getAsciiRegexp();
            $asciiRX = ($this->riskyMatchAscii) ? '|(()'.$asciiRegexp.'())' : '|((\\s|^)'.$asciiRegexp.'(?=\\s|$|[!,.?]))';

            $string = preg_replace_callback('/'.$this->ignoredRegexp.$asciiRX.'/S', $this->asciiToImageCallback(...), (string) $string);
        }

        return $string;
    }

    /**
     * This will return the shortname from unicode input.
     *
     * @param   string  $string The input string.
     * @return  string  shortname
     */
    public function toShort($string): ?string
    {
        return preg_replace_callback('/'.$this->ignoredRegexp.'|'.$this->unicodeRegexp.'/ui', $this->toShortCallback(...), $string);
    }

    // ##########################################
    // ######## preg_replace callbacks
    // ##########################################

    /**
     * @param array $m  Results of preg_replace_callback().
     * @return  string  Ascii replacement result.
     */
    public function shortnameToAsciiCallback(array $m): string
    {
        if ((empty($m[1])))
        {
            return $m[0];
        }
        $ruleset = $this->getRuleset();
        $shortcode_replace = $ruleset->getShortcodeReplace();
        $ascii_replace = $ruleset->getAsciiReplace();
        $aflipped = array_flip($ascii_replace);
        $shortname = $m[0];
        if (!isset($shortcode_replace[$shortname]))
        {
            return $m[0];
        }
        return $aflipped[$shortname] ?? $shortname;
    }

    /**
     * @param array $m  Results of preg_replace_callback().
     * @return  string  Unicode replacement result.
     */
    public function shortnameToUnicodeCallback(array $m): string
    {
        if ((!is_array($m)) || (!isset($m[1])) || (empty($m[1]))) {
            return $m[0];
        }
        $ruleset = $this->getRuleset();
        $unicode_replace = $ruleset->getUnicodeReplace();
        $shortname = mb_strtolower((string) $m[1]);
        return $unicode_replace[$shortname] ?? $m[0];
    }

    /**
     * @param   array   $m  Results of preg_replace_callback().
     * @return  string  Image HTML replacement result.
     */
    public function shortnameToImageCallback($m)
    {
        if ((!is_array($m)) || (!isset($m[1])) || (empty($m[1]))) {
            return $m[0];
        }
        $ruleset = $this->getRuleset();
        $shortcode_replace = $ruleset->getShortcodeReplace();
        $shortname = $m[1];
        if (!isset($shortcode_replace[$shortname]))
        {
            return $m[0];
        }
        $unicode = $shortcode_replace[$shortname][0];
        $filename = $shortcode_replace[$shortname][1];
        $category = (str_contains($filename, '-1f3f')) ? 'diversity' : $shortcode_replace[$shortname][2];
        $titleTag = $this->imageTitleTag ? 'title="'.htmlspecialchars($shortname).'"' : '';
        $alt = $this->unicodeAlt ? $this->convert($unicode) : $shortname;
        if ($this->sprites)
        {
            return '<span class="joypixels joypixels-'.$this->spriteSize.'-'.$category.' _'.$filename.'" '.$titleTag.'>'.$alt.'</span>';
        }
        return '<img class="joypixels" alt="'.$alt.'" '.$titleTag.' src="' . $this->imagePathPNG . $filename . $this->fileExtension . '"/>';
    }

    /**
     * @param   array   $m  Results of preg_replace_callback().
     * @return  string  Unicode replacement result.
     */
    public function asciiToUnicodeCallback($m)
    {
        if ((!is_array($m)) || (!isset($m[3])) || (empty($m[3])))
        {
            return $m[0];
        }
        $ruleset = $this->getRuleset();
        $ascii_replace = $ruleset->getAsciiReplace();
        $ascii = $m[3];
        if ( empty($ascii_replace[$ascii]) )
        {
            return $m[3];
        }
        $shortname = $ascii_replace[$ascii];
        $unicode_replace = $ruleset->getUnicodeReplace();
        return $unicode_replace[$shortname];
    }

    /**
     * @param   array   $m  Results of preg_replace_callback().
     * @return  string  Shortname replacement result.
     */
    public function asciiToShortnameCallback($m)
    {
        if ((!is_array($m)) || (!isset($m[3])) || (empty($m[3])))
        {
            return $m[0];
        }
        $ruleset = $this->getRuleset();
        $ascii_replace = $ruleset->getAsciiReplace();
        $ascii = $m[3];
        if ( empty($ascii_replace[$ascii]) )
        {
            return $m[3];
        }
        $shortname = $ascii_replace[$ascii];
        return ' ' . $shortname;
    }

    /**
     * @param   array   $m  Results of preg_replace_callback().
     * @return  string  Image HTML replacement result.
     */
    public function asciiToImageCallback($m)
    {
        if ((!is_array($m)) || (!isset($m[3])) || (empty($m[3])))
        {
            return $m[0];
        }
        $ruleset = $this->getRuleset();
        $ascii_replace = $ruleset->getAsciiReplace();
        $shortcode_replace = $ruleset->getShortcodeReplace();
        $ascii = html_entity_decode((string) $m[3]);
        if ( empty($ascii_replace[$ascii]) )
        {
            return $m[3];
        }
        $shortname = $ascii_replace[$ascii];
        $filename = $shortcode_replace[$shortname][1];
        $uc_output = $shortcode_replace[$shortname][0];
        $category = (str_contains($filename, '-1f3f')) ? 'diversity' : $shortcode_replace[$shortname][2];
        $titleTag = $this->imageTitleTag ? 'title="'.htmlspecialchars($shortname).'"' : '';
        // unicode char or shortname for the alt tag? (unicode is better for copying and pasting the resulting text)
        $alt = $this->unicodeAlt ? $this->convert($uc_output) : htmlspecialchars($ascii);
        if ($this->sprites)
        {
            return $m[2].'<span class="joypixels joypixels-'.$this->spriteSize.'-'.$category.' _'.$filename.'" '.$titleTag.'>'.$alt.'</span>';
        }
        return $m[2].'<img class="joypixels" alt="'.$alt.'" '.$titleTag.' src="' . $this->imagePathPNG . $filename . $this->fileExtension .'"/>';
    }

    /**
     * @param   array   $m  Results of preg_replace_callback().
     * @return  string  shortname result
     */
    public function toShortCallback($m)
    {
        if ((!is_array($m)) || (!isset($m[0])) || (empty($m[0])))
        {
            return $m[0];
        }
        $ruleset = $this->getRuleset();
        $unicode_replace = $ruleset->getUnicodeReplace();
        $unicode = $m[0];
        $shortname = array_search($unicode, $unicode_replace, false);
        return ($shortname === false) ? $unicode : $shortname;
    }

    // ##########################################
    // ######## helper methods
    // ##########################################

    /**
     * Converts from unicode to hexadecimal NCR.
     *
     * @param   string  $unicode unicode character/s
     * @return  string  hexadecimal NCR
     * */
    public function convert(string $unicode): string
    {
        if (stristr($unicode,'-'))
        {
            $pairs = explode('-',$unicode);
            return '&#x'.implode(';&#x',$pairs).';';
        }
        return '&#x'.$unicode.';';
    }

    /**
     * Get the Ruleset
     *
     * @return RulesetInterface The Ruleset
     */
    public function getRuleset()
    {
        if ( $this->ruleset === null )
        {
            $this->ruleset = new Ruleset;
        }

        return $this->ruleset;
    }
}
