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
        [$x, $y] = [self::luminance($a), self::luminance($b)];

        return (max($x, $y) + 0.05) / (min($x, $y) + 0.05);
    }

    /**
     * `$color`, moved away from `$ground` in lightness, in fiftieths of the way
     * to black or white, until they contrast by `$ratio`, or as far as it goes.
     */
    public static function ensure(string $color, string $ground, float $ratio): string
    {
        $away = self::luminance($ground) > 0.18 ? '#000000' : '#ffffff';
        $adjusted = $color;

        for ($step = 1; $step <= 50 && self::ratio($adjusted, $ground) < $ratio; $step++) {
            $adjusted = Ramp::mix($color, $away, $step / 50);
        }

        return $adjusted;
    }

    private static function luminance(string $hex): float
    {
        [$r, $g, $b] = Ramp::linear($hex);

        return 0.2126 * $r + 0.7152 * $g + 0.0722 * $b;
    }
}
