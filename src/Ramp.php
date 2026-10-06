<?php

namespace JothamLec\EditorThemes;

/**
 * Statamic's grey ramp has fourteen shades, 50 to 950, and an editor palette
 * has fewer neutrals. A theme places its own at the shades they suit, and
 * the shades between are mixed in OKLab, where an even mix looks even.
 */
final class Ramp
{
    public const array SHADES = [50, 100, 150, 200, 300, 400, 500, 600, 700, 800, 850, 900, 925, 950];

    /**
     * @param  array<int, string>  $anchors  hex colours at some of the shades, always 50 and 950
     * @return array<int, string> every shade, light to dark
     */
    public static function fill(array $anchors): array
    {
        ksort($anchors);
        $shades = array_keys($anchors);

        return collect(self::SHADES)->mapWithKeys(function (int $shade) use ($anchors, $shades) {
            if (isset($anchors[$shade])) {
                return [$shade => $anchors[$shade]];
            }

            $below = max(array_filter($shades, fn (int $s) => $s < $shade));
            $above = min(array_filter($shades, fn (int $s) => $s > $shade));

            return [$shade => self::mix($anchors[$below], $anchors[$above], ($shade - $below) / ($above - $below))];
        })->all();
    }

    /** `$t` of the way from `$from` to `$to`, in OKLab. */
    public static function mix(string $from, string $to, float $t): string
    {
        [$a, $b] = [self::toOklab($from), self::toOklab($to)];

        return self::fromOklab(array_map(fn (float $x, float $y) => $x + ($y - $x) * $t, $a, $b));
    }

    /** @return array{float, float, float} */
    private static function toOklab(string $hex): array
    {
        [$r, $g, $b] = array_map(function (string $pair) {
            $c = hexdec($pair) / 255;

            return $c <= 0.04045 ? $c / 12.92 : (($c + 0.055) / 1.055) ** 2.4;
        }, str_split(ltrim($hex, '#'), 2));

        $l = (0.4122214708 * $r + 0.5363325363 * $g + 0.0514459929 * $b) ** (1 / 3);
        $m = (0.2119034982 * $r + 0.6806995451 * $g + 0.1073969566 * $b) ** (1 / 3);
        $s = (0.0883024619 * $r + 0.2817188376 * $g + 0.6299787005 * $b) ** (1 / 3);

        return [
            0.2104542553 * $l + 0.7936177850 * $m - 0.0040720468 * $s,
            1.9779984951 * $l - 2.4285922050 * $m + 0.4505937099 * $s,
            0.0259040371 * $l + 0.7827717662 * $m - 0.8086757660 * $s,
        ];
    }

    /** @param array{float, float, float} $lab */
    private static function fromOklab(array $lab): string
    {
        [$L, $a, $b] = $lab;
        $l = ($L + 0.3963377774 * $a + 0.2158037573 * $b) ** 3;
        $m = ($L - 0.1055613458 * $a - 0.0638541728 * $b) ** 3;
        $s = ($L - 0.0894841775 * $a - 1.2914855480 * $b) ** 3;

        $linear = [
            4.0767416621 * $l - 3.3077115913 * $m + 0.2309699292 * $s,
            -1.2684380046 * $l + 2.6097574011 * $m - 0.3413193965 * $s,
            -0.0041960863 * $l - 0.7034186147 * $m + 1.7076147010 * $s,
        ];

        return '#'.implode('', array_map(function (float $c) {
            $c = $c <= 0.0031308 ? 12.92 * $c : 1.055 * $c ** (1 / 2.4) - 0.055;

            return sprintf('%02x', (int) round(max(0, min(1, $c)) * 255));
        }, $linear));
    }
}
