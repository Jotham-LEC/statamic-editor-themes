<?php

namespace JothamLec\EditorThemes;

/**
 * WCAG contrast. Editor palettes pick accents for code on their own ground,
 * and some, Solarized's and Everforest's light ones for instance, are too
 * pale for a link or under a button's white text. Those are taken darker
 * (or, on a dark ground, lighter) only as far as they need to read.
 */
final class Contrast
{
    public static function ratio(string $a, string $b): float
    {
        [$light, $dark] = [max(self::luminance($a), self::luminance($b)), min(self::luminance($a), self::luminance($b))];

        return ($light + 0.05) / ($dark + 0.05);
    }

    /** `$color`, moved away from `$ground` in lightness until they contrast by `$ratio`. */
    public static function ensure(string $color, string $ground, float $ratio): string
    {
        $away = self::luminance($ground) > 0.18 ? '#000000' : '#ffffff';

        for ($t = 0.0, $adjusted = $color; $t <= 1 && self::ratio($adjusted, $ground) < $ratio; $t += 0.02) {
            $adjusted = Ramp::mix($color, $away, $t);
        }

        return $adjusted;
    }

    private static function luminance(string $hex): float
    {
        [$r, $g, $b] = array_map(function (string $pair) {
            $c = hexdec($pair) / 255;

            return $c <= 0.04045 ? $c / 12.92 : (($c + 0.055) / 1.055) ** 2.4;
        }, str_split(ltrim($hex, '#'), 2));

        return 0.2126 * $r + 0.7152 * $g + 0.0722 * $b;
    }
}
